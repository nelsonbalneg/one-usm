<!DOCTYPE html>
<html>

<head>
    <title>Room Re-Assignment Notification</title>
</head>

<body>
    <h2>Hi there, {{ $data['fullname'] }}</h2>
    <p>We would like to inform you that your room assignment has been updated. Below are the details of your new room assignment:</p>
    <ul>
        <li><strong>Campus:</strong> {{ $data['campus'] }}</li>
        <li><strong>Building:</strong> {{ $data['college_name'] }}</li>
        <li><strong>Room Name:</strong> {{ $data['room_name'] }}</li>
        <li><strong>Time:</strong> {{ $data['time'] }}</li>
        <li><strong>Schedule:</strong> {{ \Carbon\Carbon::parse($data['schedule'])->format('F j, Y') }}</li>
        <li><strong>Batch:</strong> {{ $data['exam_session'] }}</li>
    </ul>
    <p><i>This is a system generated email, please do not reply.</i> Kindly login to https://cee.usm.edu.ph and re-download your cee-slip. </p>
    <p>If you have any questions or concerns, feel free to contact us via <a href="https://agapay.usm.edu.ph">https://agapay.usm.edu.ph</a>.</p>

    <p>Best regards,</p>
    <p>USMCEE 4.0 Team</p>
</body>
</html>
