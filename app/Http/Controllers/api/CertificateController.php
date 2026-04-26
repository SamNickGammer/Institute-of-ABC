<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CertificateController extends Controller
{
    private function getVerificationBaseUrl()
    {
        return 'http://abcedupro.com';
    }

    private function buildStudentVerificationUrl($registrationNumber, $dob)
    {
        if (!$registrationNumber || !$dob) {
            return null;
        }

        return $this->getVerificationBaseUrl() . '/student_info?' . http_build_query([
            'rn' => $registrationNumber,
            'dob' => $dob,
        ], '', '&', PHP_QUERY_RFC3986);
    }

    private function buildQrCodeImageUrl($targetUrl, $size = 140)
    {
        if (!$targetUrl) {
            return null;
        }

        $qrSize = max(80, (int) $size);

        return 'https://api.qrserver.com/v1/create-qr-code/?size=' . $qrSize . 'x' . $qrSize . '&margin=0&format=png&data=' . rawurlencode($targetUrl);
    }

    private function detectImageMimeType($source = null, $contents = null)
    {
        if ($contents) {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $detected = $finfo->buffer($contents);
            if ($detected && strpos($detected, 'image/') === 0) {
                return $detected;
            }
        }

        $extension = strtolower(pathinfo((string) $source, PATHINFO_EXTENSION));
        $mimeByExtension = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
        ];

        return $mimeByExtension[$extension] ?? 'image/jpeg';
    }

    private function imageContentsToDataUri($contents, $source = null)
    {
        if (!$contents) {
            return null;
        }

        return 'data:' . $this->detectImageMimeType($source, $contents) . ';base64,' . base64_encode($contents);
    }

    private function resolveStudentPhotoPath($imageUrl)
    {
        if (!$imageUrl) {
            return null;
        }

        $parsedPath = parse_url($imageUrl, PHP_URL_PATH) ?: $imageUrl;
        $relativePath = ltrim(urldecode($parsedPath), '/');
        $candidates = [];

        if ($relativePath !== '') {
            $candidates[] = public_path($relativePath);
            $candidates[] = base_path($relativePath);
        }

        if (preg_match('#student_photo/(\d+)#', $relativePath, $matches)) {
            $studentPhotoDir = public_path('student_photo/' . $matches[1]);

            if ($relativePath !== '') {
                $candidates[] = $studentPhotoDir . '/' . basename($relativePath);
            }

            if (is_dir($studentPhotoDir)) {
                $files = glob($studentPhotoDir . '/*');
                if ($files) {
                    foreach ($files as $file) {
                        if (is_file($file)) {
                            $candidates[] = $file;
                        }
                    }
                }
            }
        }

        foreach (array_unique($candidates) as $candidate) {
            if ($candidate && is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    private function imageUrlToDataUri($imageUrl)
    {
        if (!$imageUrl) {
            return null;
        }

        try {
            $localPath = $this->resolveStudentPhotoPath($imageUrl);
            if ($localPath) {
                $contents = @file_get_contents($localPath);
                if ($contents !== false) {
                    return $this->imageContentsToDataUri($contents, $localPath);
                }
            }

            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $context = stream_context_create([
                    'http' => ['timeout' => 5],
                    'https' => ['timeout' => 5],
                ]);
                $contents = @file_get_contents($imageUrl, false, $context);
                if ($contents !== false) {
                    return $this->imageContentsToDataUri($contents, $imageUrl);
                }
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }

    private function getStudentData($studentId)
    {
        return DB::table('student')
            ->join('courses', 'student.student_course_id', '=', 'courses.course_id')
            ->join('branch', 'student.branch_id', '=', 'branch.id')
            ->where('student.student_id', $studentId)
            ->select(
                'student.*',
                'courses.course_name', 'courses.short_form', 'courses.course_duration',
                'branch.branch_name', 'branch.branch_code',
                'branch.first_name as branch_director_first',
                'branch.last_name as branch_director_last',
                'branch.address_line1 as branch_address'
            )
            ->first();
    }

    private function formatDate($date)
    {
        if (!$date) return '';
        return date('d/m/Y', strtotime($date));
    }

    private function downloadPdfFromView($viewName, array $data, $filename)
    {
        if (!class_exists(\Dompdf\Options::class) || !class_exists(\Dompdf\Dompdf::class)) {
            return response(View::make($viewName, $data)->render(), 200, [
                'Content-Type' => 'text/html; charset=UTF-8',
            ]);
        }

        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setChroot(base_path());

        $dompdf = new \Dompdf\Dompdf($options);
        $html = View::make($viewName, $data)->render();

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('a4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function downloadCertificate(Request $request)
    {
        $studentId = $request->query('student_id');
        if (!$studentId) {
            return response()->json(['error' => true, 'message' => 'Missing student_id'], 400);
        }

        $student = $this->getStudentData($studentId);
        if (!$student) {
            return response()->json(['error' => true, 'message' => 'Student not found'], 404);
        }
        if (!$student->is_certificate_approve) {
            return response()->json(['error' => true, 'message' => 'Certificate not approved'], 403);
        }

        $templatePath = public_path('assets/certificates/certi_sample.jpg');
        $templateBase64 = base64_encode(file_get_contents($templatePath));

        $branchDirector = trim(($student->branch_director_first ?? '') . ' ' . ($student->branch_director_last ?? ''));
        $durationText = $student->course_duration . ' Month' . ($student->course_duration > 1 ? 's' : '');
        $studyCentre = strtoupper($student->branch_name ?? '') . ', ' . strtoupper($student->branch_address ?? '');
        $dateCertified = $this->formatDate($student->admission_date) . ' TO ' . $this->formatDate($student->relieving_date);
        $courseFull = $student->course_name . ($student->short_form ? ' (' . $student->short_form . ')' : '');

        $data = [
            'templateBase64' => $templateBase64,
            'studentName' => strtoupper($student->student_name),
            'fatherName' => strtoupper($student->student_father_name),
            'registrationNumber' => strtoupper($student->registration_number),
            'courseName' => strtoupper($courseFull),
            'duration' => strtoupper($durationText),
            'performance' => strtoupper($student->performance ?? ''),
            'overallPercent' => ($student->overall_percent ?? '') . ' %',
            'studyCentre' => $studyCentre,
            'centreCode' => strtoupper($student->branch_code),
            'srNo' => $student->marksheet_id ?? '',
            'dateOfIssue' => $this->formatDate($student->certified_date),
            'dateCertified' => $dateCertified,
            'branchDirector' => strtoupper($branchDirector),
        ];

        $filename = 'Certificate_' . str_replace('/', '-', $student->registration_number) . '.pdf';
        return $this->downloadPdfFromView('pdf.certificate', $data, $filename);
    }

    public function downloadMarksheet(Request $request)
    {
        $studentId = $request->query('student_id');
        if (!$studentId) {
            return response()->json(['error' => true, 'message' => 'Missing student_id'], 400);
        }

        $student = $this->getStudentData($studentId);
        if (!$student) {
            return response()->json(['error' => true, 'message' => 'Student not found'], 404);
        }
        if ($student->marksheet_stage !== 'verified') {
            return response()->json(['error' => true, 'message' => 'Marksheet not verified'], 403);
        }

        $templatePath = public_path('assets/certificates/marks_sample.jpg');
        $templateBase64 = base64_encode(file_get_contents($templatePath));

        $marks = json_decode($student->marks, true) ?? [];
        $durationText = $student->course_duration . ' Month' . ($student->course_duration > 1 ? 's' : '');
        $studyCentre = strtoupper($student->branch_name ?? '') . ', ' . strtoupper($student->branch_address ?? '');
        $dateCertified = $this->formatDate($student->admission_date) . ' TO ' . $this->formatDate($student->relieving_date);
        $studentPhotoSrc = $this->imageUrlToDataUri($student->student_photo) ?: $student->student_photo;
        $verificationUrl = $this->buildStudentVerificationUrl($student->registration_number, $student->dob);
        $verificationQrUrl = $this->buildQrCodeImageUrl($verificationUrl);
        $verificationQrSrc = $this->imageUrlToDataUri($verificationQrUrl) ?: $verificationQrUrl;

        $data = [
            'templateBase64' => $templateBase64,
            'studentName' => strtoupper($student->student_name),
            'dob' => strtoupper($student->dob ?? ''),
            'motherName' => strtoupper($student->student_mother_name),
            'fatherName' => strtoupper($student->student_father_name),
            'registrationNumber' => strtoupper($student->registration_number),
            'courseName' => strtoupper($student->short_form ?: $student->course_name),
            'duration' => strtoupper($durationText),
            'studyCentre' => $studyCentre,
            'centreCode' => strtoupper($student->branch_code),
            'srNo' => $student->marksheet_id ?? '',
            'dateOfIssue' => $this->formatDate($student->certified_date),
            'dateCertified' => $dateCertified,
            'writtenMarks' => $marks['Written Marks'] ?? '-',
            'practicalMarks' => $marks['Practical Marks'] ?? '-',
            'projectMarks' => $marks['Project Marks'] ?? '-',
            'vivaMarks' => $marks['Viva Marks'] ?? '-',
            'overallPercent' => ($student->overall_percent ?? '') . ' %',
            'performance' => strtoupper($student->performance ?? ''),
            'studentPhotoSrc' => $studentPhotoSrc,
            'verificationUrl' => $verificationUrl,
            'verificationQrSrc' => $verificationQrSrc,
        ];

        $filename = 'Marksheet_' . str_replace('/', '-', $student->registration_number) . '.pdf';
        return $this->downloadPdfFromView('pdf.marksheet', $data, $filename);
    }
}
