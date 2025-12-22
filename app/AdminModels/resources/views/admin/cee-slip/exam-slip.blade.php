<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USMCEE Examination Slip </title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
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
            /* Slightly smaller to avoid overflow */
            box-sizing: border-box;
            font-size: 9pt;

            -webkit-user-select: none;
            /* Safari */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* IE/Edge */
            user-select: none;
            /* Standard */
        }

        .container {
            width: 100%;
            padding: 0;
            /* Remove padding */
            box-sizing: border-box;
            position: relative;
            margin-bottom: 30px;
            /* Space for footer */
        }

        .header,
        .section {
            width: 100%;
            margin-bottom: 5px;
            page-break-inside: avoid;
            /* Avoid page break inside */
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
            /* Prevent tables from breaking across pages */
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
            position: fixed;
            /* Changed from absolute to fixed */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            color: rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            z-index: -1;
            pointer-events: none;
            opacity: 0.3;
            /* 20% opacity */
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
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 7pt;
            color: rgb(46, 46, 46);
            background-color: white;
            padding-bottom: 10px;
        }

        .map-page {
            position: relative;
            page-break-before: always;
            margin-bottom: 20px;
            /* Space for footer */
        }

        .map-image {
            width: 100%;
            height: auto;
            max-height: 95%;
            object-fit: contain;
        }

        @media print {

            .watermark,
            .footer {
                position: fixed;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .page-content {
                margin-bottom: 20px;
                /* Space for footer on each page */
            }
        }
    </style>
</head>

<body>

    <!-- Watermark that appears on all pages -->
    <div class="watermark">
        @php
            $app_no = $cee_reservation->app_no;
        @endphp

        @for ($i = 0; $i < 55; $i++)
            <p>USMCEE -2025 {{ $app_no }} USMCEE -2025 {{ $app_no }} USMCEE -2025 {{ $app_no }}
                USMCEE -2025 {{ $app_no }} USMCEE -2025 {{ $app_no }} USMCEE -2025
                {{ $app_no }}
                USMCEE -2025 {{ $app_no }} USMCEE -2025 {{ $app_no }} USMCEE -2025 USMCEE -2025
            </p>
        @endfor
    </div>

    <!-- Footer that appears on all pages -->
    <div class="footer">
        <p>Downloaded Date and Time:
            {{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i:s A') }}
        </p>
        <p style="margin-top:-8px;">Browser Agent: {{ request()->header('User-Agent') }}</p>
        <p style="margin-top:-8px; color:green"> University of Southern Mindanao - College Entrance Examination
            Reservation
            System v4.0 | <b>Powered by: UICTO</b></p>
    </div>


    <div class="container page-content">
        <div class="header">

            <img src="{{ public_path('backend/assets/images/logo/OFFICIAL_USM_LOGO.png') }}" alt="University Logo"
                class="left-logo">
             <img src="{{ $qrCodeUrl }}" alt="QR Code" class="right-logo" />
            <div>University of Southern Mindanao</div>
            <div>UNIVERSITY TEST DEVELOPMENT CENTER</div>
            <div style="font-size: 10pt;">Kabacan, Cotabato</div>
            <br>

            <div style="color: seagreen;">UNIVERSITY OF SOUTHERN MINDANAO <br>
                COLLEGE ENTRANCE EXAMINATION (USMCEE)</div>
            <div class="title">Entrance Examination Slip</div>
        </div>

        <div class="row d-flex justify-content-center" style="margin-bottom: 10px; margin-top:40px;">
            <div class="col">
                <div class="text-left">
                    <span class="info-item"><b>Congratulations!</b><br><br> You have successfully reserved a slot for
                        the
                        USMCEE.
                        Below are your reservation details:</span>
                </div>

            </div>
        </div>

        <table style="margin-bottom: 10px; width: 100%;">
            <tr>
                <th colspan="2" style="text-align: center; background-color: mediumaquamarine;">CEE RESERVATION
                    DETAILS</th>
            </tr>
            <tr>
                <!-- Left Column -->
                <td style="vertical-align: top; width: 50%;">
                    <table style="width: 100%;">
                        <img style="width: 100px; height: 100px; margin-left: 120px;" src="http://172.16.0.43/uploads/{{ basename($cee_reservation->photo) }}" alt="No Photo">
                        {{-- <img src="data:image/jpeg;base64,{{ $compressedPhotoBase64 }}" alt="No Photo"
                            style="width: 100px; height: 100px; margin-left: 120px;"> --}}

                        {{-- @if (!empty($compressedPhotoBase64))
                            <img src="data:image/jpeg;base64,{{ $compressedPhotoBase64 }}" alt="Student Photo"
                                style="width: 100px; height: 100px; margin-left: 120px;">
                        @else
                            <p style="text-align: center; margin-left: 120px;">No photo available</p>
                        @endif --}}
                        <p style="text-align: center;">App No.: <b>{{ $cee_reservation->app_no }}</b><br>
                            Full Name: <b>{{ $cee_reservation->lastname }},
                                {{ $cee_reservation->firstname }}
                                {{ $cee_reservation->middlename ?? '' }}
                                {{ $cee_reservation->suffix ?? '' }}</b>
                        </p>
                    </table>
                </td>

                <!-- Right Column -->
                <td style="vertical-align: top; width: 50%;">
                    <table style="width: 100%;">
                        <tr>
                            <th style="text-align: left; width: 100px; border: none; background-color: white;">Test
                                Session:</th>
                            <td style="border: none;">{{ $cee_reservation->exam_session }}</td>
                        </tr>

                        <tr>
                            <th style="text-align: left; width: 100px; border: none; background-color: white;">Test
                                Venue:</th>
                            <td style="border: none;">
                                ({{ $cee_reservation->campus }}) {{ $cee_reservation->college_name }} /
                                {{ $cee_reservation->room_name }}
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align: left; width: 100px; border: none; background-color: white;">Date and
                                Time:</th>
                            <td style="border: none;">
                                {{ \Carbon\Carbon::parse($cee_reservation->schedule)->format('F j, Y') }} /
                                {{ $cee_reservation->time }}
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align: left; width: 100px; border: none; background-color: white;">CEE
                                Applicant Type:</th>
                            <td style="border: none;">
                                @if ($cee_reservation->is_repeat_exam === 'Yes')
                                    Retaker
                                @else
                                    First Time Taker
                                @endif
                            </td>
                        </tr>


                    </table>
                </td>
            </tr>
        </table>
        <table class="table table-borderless">
            <tr>
                <td style=" border: none;">
                    <h3>Requirements upon entry to the testing center/venue:</h3>
                    <ul>
                        <li>Printed examination slip (generated after successful registration)</li>
                        <li>One (1) Valid ID (Government-Issued ID, High School ID, Company ID, and National ID)</li>
                        <li>Personal ballpen (not sign pen)</li>
                        <li>Pencil and sharpener</li>
                        <li>Snacks and water (no single-use plastic containers; tumblers only)</li>
                        <li>Transparent bag or envelope for personal items</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <!-- Second page content -->
    @if (!empty($cee_reservation->map_file))
        <img src="{{ public_path('backend/assets/images/map/' . Str::lower($cee_reservation->map_file) . '.png') }}"
            alt="{{ $cee_reservation->map_file }}" class="map-image">
    @else
        <p style="text-align: center; color: red;">No map available</p>
    @endif

</body>

</html>
