<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
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

        $pdf = Pdf::loadView('pdf.certificate', $data);
        $pdf->setPaper('a4', 'landscape');

        $filename = 'Certificate_' . str_replace('/', '-', $student->registration_number) . '.pdf';
        return $pdf->download($filename);
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

        $data = [
            'templateBase64' => $templateBase64,
            'studentName' => strtoupper($student->student_name),
            'motherName' => strtoupper($student->student_mother_name),
            'fatherName' => strtoupper($student->student_father_name),
            'registrationNumber' => strtoupper($student->registration_number),
            'courseName' => strtoupper($student->course_name),
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
        ];

        $pdf = Pdf::loadView('pdf.marksheet', $data);
        $pdf->setPaper('a4', 'landscape');

        $filename = 'Marksheet_' . str_replace('/', '-', $student->registration_number) . '.pdf';
        return $pdf->download($filename);
    }
}
