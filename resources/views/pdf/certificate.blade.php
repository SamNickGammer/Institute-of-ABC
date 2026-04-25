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
        font-family: sans-serif;
        color: #000;
        font-weight: bold;
        letter-spacing: 0.5px;
        text-align: center;
    }
</style>
</head>
<body>
<div class="page">
<div class="container">
    <img src="data:image/jpeg;base64,{{ $templateBase64 }}" alt="Certificate template">

    {{-- Student Name (Mr./Ms./Mrs. line) --}}
    <div class="field" style="top: 28.5%; left: 32%; width: 63%; font-size: 13px;">{{ $studentName }}</div>

    {{-- Father's Name --}}
    <div class="field" style="top: 33.5%; left: 33%; width: 62%; font-size: 13px;">{{ $fatherName }}</div>

    {{-- Registration Number --}}
    <div class="field" style="top: 38.75%; left: 37%; width: 49%; font-size: 13px;">{{ $registrationNumber }}</div>

    {{-- Course Name (completion of line) --}}
    <div class="field" style="top: 44%; left: 32%; width: 59%; font-size: 13px;">{{ $courseName }}</div>

    {{-- Duration --}}
    <div class="field" style="top: 49%; left: 30%; width: 24%; font-size: 13px;">{{ $duration }}</div>

    {{-- Performance --}}
    <div class="field" style="top: 49%; left: 58%; width: 29%; font-size: 13px;">{{ $performance }}</div>

    {{-- Overall Marks/Percent --}}
    <div class="field" style="top: 54.25%; left: 33%; width: 55%; font-size: 13px;">{{ $overallPercent }}</div>

    {{-- Study Centre --}}
    <div class="field" style="top: 59.5%; left: 33%; width: 58%; font-size: 12px;">{{ $studyCentre }}</div>

    {{-- Centre Code --}}
    <div class="field" style="top: 64.5%; left: 31%; width: 62%; font-size: 13px;">{{ $centreCode }}</div>

    {{-- Sr. No. (inside box) --}}
    <div class="field" style="top: 57.5%; left: 11%; width: 9%; font-size: 13px;">{{ $srNo }}</div>

    {{-- Date of Issue --}}
    <div class="field" style="top: 66%; left: 9%; font-size: 13px; text-align: left;">{{ $dateOfIssue }}</div>

    {{-- Branch Director Name --}}
    <div class="field" style="top: 76%; left: 6%; width: 26%; font-size: 11px;">{{ $branchDirector }}</div>

    {{-- Date Certified (admission TO relieving) --}}
    <div class="field" style="top: 76%; left: 65%; width: 34%; font-size: 13px;">{{ $dateCertified }}</div>
</div>
</div>
</body>
</html>
