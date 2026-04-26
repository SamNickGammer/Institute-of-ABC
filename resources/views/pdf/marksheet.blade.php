<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { size: A4 landscape; margin: 0; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { margin: 0; padding: 0; width: 297mm; height: 210mm; }
    .page { position: relative; width: 297mm; height: 210mm; overflow: hidden; background: #fff; }
    .container { position: absolute; top: 9.96mm; left: 0; width: 297mm; height: 190.08mm; overflow: hidden; }
    .container img { position: absolute; top: 0; left: 0; width: 297mm; height: 190.08mm; }
    .field {
        position: absolute;
        font-family: Helvetica, Arial, sans-serif;
        color: #000;
        font-weight: 400;
        letter-spacing: 0.2px;
        white-space: nowrap;
    }
    .field.markst {
        font-family: Helvetica, Arial, sans-serif;
        font-weight: 400;
    }
</style>
</head>
<body>
<div class="page">
<div class="container">
    <img src="data:image/jpeg;base64,{{ $templateBase64 }}" alt="Marksheet template">

    {{-- Registration No --}}
    <div class="field markst" style="top: 29%; left: 34%; font-size: 12px;">{{ $registrationNumber }}</div>

    {{-- Student Name --}}
    <div class="field markst" style="top: 38.8%; left: 34%; font-size: 12px;">{{ $studentName }}</div>

    {{-- Date of Birth --}}
    <div class="field markst" style="top: 42.2%; left: 34%; font-size: 12px;">{{ $dob }}</div>

    {{-- Mother's Name --}}
    <div class="field markst" style="top: 45.5%; left: 34%; font-size: 12px;">{{ $motherName }}</div>

    {{-- Father's Name --}}
    <div class="field markst" style="top: 48.8%; left: 34%; font-size: 12px;">{{ $fatherName }}</div>

    {{-- Course Name --}}
    <div class="field markst" style="top: 52.2%; left: 34%; font-size: 12px;">{{ $courseName }}</div>

    {{-- Duration --}}
    <div class="field markst" style="top: 55.5%; left: 34%; font-size: 12px;">{{ $duration }}</div>

    {{-- Study Centre --}}
    <div class="field markst" style="top: 58.8%; left: 34%; font-size: 12px;">{{ $studyCentre }}</div>

    {{-- Centre Code --}}
    <div class="field markst" style="top: 62%; left: 34%; font-size: 12px;">{{ $centreCode }}</div>

    {{-- Sr. No. --}}
    <div class="field markst" style="top: 51.8%; left: 12%; font-size: 12px;">{{ $srNo }}</div>

    {{-- Date of Issue --}}
    <div class="field markst" style="top: 59.2%; left: 9%; font-size: 12px;">{{ $dateOfIssue }}</div>

    {{-- Marks Obtained --}}
    <div class="field markst" style="top: 31.8%; left: 86%; font-size: 14px; text-align: center; width: 8%;">{{ $writtenMarks }}</div>
    <div class="field markst" style="top: 35.3%; left: 86%; font-size: 14px; text-align: center; width: 8%;">{{ $practicalMarks }}</div>
    <div class="field markst" style="top: 39%; left: 86%; font-size: 14px; text-align: center; width: 8%;">{{ $projectMarks }}</div>
    <div class="field markst" style="top: 42.5%; left: 86%; font-size: 14px; text-align: center; width: 8%;">{{ $vivaMarks }}</div>

    {{-- Overall Percentage --}}
    <div class="field markst" style="top: 46.5%; left: 77%; font-size: 12px; text-align: center;">{{ $overallPercent }}</div>

    {{-- Performance --}}
    <div class="field markst" style="top: 49.9%; left: 72%; font-size: 12px; text-align: center;">{{ $performance }}</div>

    {{-- Date Certified --}}
    <div class="field markst" style="top: 69.2%; left: 75%; font-size: 12px; text-align: center;">{{ $dateCertified }}</div>

    @if(!empty($verificationQrSrc))
    <img
        src="{{ $verificationQrSrc }}"
        alt="Verification QR"
        style="position:absolute;top:28.4%;left:47.4%;width:76px;height:76px;z-index:1;border-radius:0;background:#fff;padding:2px;"
    >
    @endif

    @if(!empty($studentPhotoSrc))
    <img
        src="{{ $studentPhotoSrc }}"
        alt="Student photo"
        style="position:absolute;top:28.8%;left:54.4%;width:69px;height:73px;z-index:1;border-radius:0;"
    >
    @endif
</div>
</div>
</body>
</html>
