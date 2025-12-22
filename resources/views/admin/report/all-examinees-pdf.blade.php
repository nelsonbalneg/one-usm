
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All CEE Examineess - Report </title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">


    <style>
        @page {
            /* size: letter;
            margin: .75in; */
            size: 8.5in 13in;
            margin: .75in;
        }

        body {
            font-family: 'Corbel', sans-serif;
            margin: 0;
            padding: 0;
            /* width: calc(8.5in - 2in); */
            /* Adjusted for 1-inch margins on both sides */
            height: calc(13in - 2in);
            /* Adjusted for 1-inch margins on top and bottom */
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
            /* margin-left: 100px; */
        }

        .header .right-logo {
            left: 0;
            margin-left: 590px;
            margin-top: 410px;
            width: 120px;
            height: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #bababa;
            text-align: left;
            font-size: 10px;
            vertical-align: middle;
        }

        th {
            background-color: #cecece;
            text-align: center;
            white-space: nowrap;
        }

        .fixed-width th {
            width: 130px;
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
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 300px;
            color: #2ecc71;
            white-space: nowrap;
            z-index: -1;
            pointer-events: none;
            opacity: 0.2;
            font-family: 'Corbel', sans-serif;
            font-weight: bold;
        }

        .title {
            text-align: left;
            margin: 5px 0;
        }

        .row-height td {
            /* height: 12px; */
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

            <img src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" alt="University Logo"
                class="left-logo">
            {{-- <img src="data:image/png;base64,{{ $base64QrCode }}" alt="University Logo" class="right-logo" /> --}}
            <div style="text-align: left; margin-left: 120px;">University of Southern Mindanao</div>
            <div style="text-align: left; margin-left: 120px;">UNIVERSITY TEST DEVELOPMENT CENTER</div>
            <div style="font-size: 10pt; text-align: left; margin-left: 120px;">Kabacan, Cotabato</div>
            <br>

            <div style="color: blue; text-align: left;  margin-left: 120px;">USM COLLEGE ENTRANCE EXAMINATION</div>
            <div class="title" style="font-size: 10pt; text-align: left; margin-left: 120px;">For SY 2025-2026</div>
        </div>
        <br>

        <table style="margin-bottom: 10px; width: 100%;">
            <tr>
                <th style="background-color: #e4e4e4; text-align: left;">#</th>
                <th style="background-color: #e4e4e4; text-align: left;">Name</th>
                <th style="background-color: #e4e4e4; text-align: left;">Batch</th>
                <th style="background-color: #e4e4e4; text-align: left;">Room</th>
            </tr>
            @foreach($data as $index => $user)
            <tr>
                <td style="text-align: left; padding: 5px; border: 1px solid #ccc;">{{  $user->global_number  }}</td>
                <td style="text-align: left; padding: 5px; border: 1px solid #ccc;">{{ strtoupper($user->fullname ?? '') }}</td>
                <td style="text-align: left; padding: 5px; border: 1px solid #ccc;">{{ $user->batch_number ?? '' }}</td>
                <td style="text-align: left; padding: 5px; border: 1px solid #ccc;">{{ $user->room_name ?? '' }}</td>
            </tr>
            @endforeach
        </table>



        <div class="footer">
            <p>Downloaded Date and Time:
                {{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d h:i:s A') }}</p>
            <p style="margin-top:-8px;"> <i>University of Southern Mindanao - College Entrance Examination Reservation
                    System v4.0 | <b>
                        Powered by: UICTO</b></i></p>
        </div>

</body>

</html>
