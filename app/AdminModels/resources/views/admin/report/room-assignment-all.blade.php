<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEE Room Assignment </title>
    <style>
        @page {
            size: 8.5in 13in;
            margin: 0.25in;
        }

        body {
            font-family: 'Corbel', sans-serif;
            margin: 0;
            padding: 0;
            width: calc(8.5in - 0.5in);
            height: 12.5in;
            box-sizing: border-box;
            font-size: 9pt;
        }

        .container {
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
            page-break-inside: avoid;
        }

        .header,
        .section {
            width: 100%;
            margin-bottom: 5px;
            page-break-inside: avoid;
        }

        .section div {
            font-size: 9pt;
        }

        .header div {
            text-align: center;
            font-weight: bold;
        }

        .header img {
            position: absolute;
            top: 0;
            width: 100px;
        }

        .header .left-logo {
            left: 0;
            margin-left: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
            vertical-align: middle;
        }

        th {
            background-color: #cecece;
            text-align: center;
            white-space: nowrap;
        }

        .fixed-width th {
            width: 130px;
            height: 8px;
        }

        .equipment-specifications th,
        .equipment-specifications td {
            background-color: #a1a1a1;
        }

        .round-image {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            color: rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            z-index: -1;
            pointer-events: none;
            opacity: 0.3;
        }

        .title {
            text-align: center;
            margin: 5px 0;
        }

        .row-height td {
            height: 12px;
        }

        .text-left {
            display: flex;
            justify-content: space-between;
        }

        .info-item {
            margin-right: 40px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            color: rgb(46, 46, 46);
            font-size: 7pt;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" alt="University Logo" class="left-logo">
            <div>University of Southern Mindanao</div>
            <div>UNIVERSITY TEST DEVELOPMENT CENTER</div>
            <div style="font-size: 10pt;">Kabacan, Cotabato</div>
            <br>
            <div style="color: blue;">UNIVERSITY OF SOUTHERN MINDANAO <br> COLLEGE ENTRANCE EXAMINATION</div>
            <br>
            <br>
            <div class="title">CEE Applicant Room Assignment</div>
            <br>
        </div>
        <!-- Table to display applicants' details -->
        <table style="margin-bottom: 10px; width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Applicant Name</th>
                    <th>Batch</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $applicant)
                    <tr>
                        <td></td>
                        <td>{{ $applicant->firstname }}</td>
                        <td>{{ $applicant->exam_session }}</td>
                        <td>{{ \Carbon\Carbon::parse($applicant->schedule)->format('F j, Y') }} | {{ $applicant->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Downloaded Date and Time: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
            <p style="margin-top: -8px;"> <i>University of Southern Mindanao - College Entrance Examination Reservation System v4.0 | <b> Powered by: UICTO</b></i></p>
        </div>
    </div>
</body>

</html>
