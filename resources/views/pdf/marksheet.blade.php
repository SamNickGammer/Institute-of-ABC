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
    }
</style>
</head>
<body>
<div class="page">
<div class="container">
    <img src="data:image/jpeg;base64,{{ $templateBase64 }}" alt="Marksheet template">

    {{-- Registration No --}}
    <div class="field" style="top: 20%; left: 30%; font-size: 11px;">{{ $registrationNumber }}</div>

    {{-- Student Name --}}
    <div class="field" style="top: 32%; left: 30%; font-size: 11px;">{{ $studentName }}</div>

    {{-- Mother's Name --}}
    <div class="field" style="top: 37%; left: 30%; font-size: 11px;">{{ $motherName }}</div>

    {{-- Father's Name --}}
    <div class="field" style="top: 42%; left: 30%; font-size: 11px;">{{ $fatherName }}</div>

    {{-- Course Name --}}
    <div class="field" style="top: 47%; left: 30%; font-size: 11px;">{{ $courseName }}</div>

    {{-- Duration --}}
    <div class="field" style="top: 52%; left: 30%; font-size: 11px;">{{ $duration }}</div>

    {{-- Study Centre --}}
    <div class="field" style="top: 57%; left: 30%; font-size: 11px;">{{ $studyCentre }}</div>

    {{-- Centre Code --}}
    <div class="field" style="top: 62%; left: 30%; font-size: 11px;">{{ $centreCode }}</div>

    {{-- Sr. No. --}}
    <div class="field" style="top: 52%; left: 11%; font-size: 10px;">{{ $srNo }}</div>

    {{-- Date of Issue --}}
    <div class="field" style="top: 60%; left: 6%; font-size: 9px;">{{ $dateOfIssue }}</div>

    {{-- Marks Table - Full Marks (100 for all) --}}
    <div class="field" style="top: 20%; left: 60%; font-size: 10px; text-align: center; width: 8%;">100</div>
    <div class="field" style="top: 25%; left: 60%; font-size: 10px; text-align: center; width: 8%;">100</div>
    <div class="field" style="top: 30%; left: 60%; font-size: 10px; text-align: center; width: 8%;">100</div>
    <div class="field" style="top: 35%; left: 60%; font-size: 10px; text-align: center; width: 8%;">100</div>

    {{-- Pass Marks (40 for all) --}}
    <div class="field" style="top: 20%; left: 68%; font-size: 10px; text-align: center; width: 8%;">40</div>
    <div class="field" style="top: 25%; left: 68%; font-size: 10px; text-align: center; width: 8%;">40</div>
    <div class="field" style="top: 30%; left: 68%; font-size: 10px; text-align: center; width: 8%;">40</div>
    <div class="field" style="top: 35%; left: 68%; font-size: 10px; text-align: center; width: 8%;">40</div>

    {{-- Marks Obtained --}}
    <div class="field" style="top: 20%; left: 77%; font-size: 10px; text-align: center; width: 10%;">{{ $writtenMarks }}</div>
    <div class="field" style="top: 25%; left: 77%; font-size: 10px; text-align: center; width: 10%;">{{ $practicalMarks }}</div>
    <div class="field" style="top: 30%; left: 77%; font-size: 10px; text-align: center; width: 10%;">{{ $projectMarks }}</div>
    <div class="field" style="top: 35%; left: 77%; font-size: 10px; text-align: center; width: 10%;">{{ $vivaMarks }}</div>

    {{-- Overall Percentage --}}
    <div class="field" style="top: 40.5%; left: 68%; font-size: 10px; text-align: center; width: 19%;">{{ $overallPercent }}</div>

    {{-- Performance --}}
    <div class="field" style="top: 45.5%; left: 68%; font-size: 10px; text-align: center; width: 19%;">{{ $performance }}</div>

    {{-- Date Certified --}}
    <div class="field" style="top: 83%; left: 73%; font-size: 9px; text-align: center; width: 16%;">{{ $dateCertified }}</div>
</div>
</div>
</body>
</html>
