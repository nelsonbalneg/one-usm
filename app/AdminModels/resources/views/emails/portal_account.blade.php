<!DOCTYPE html>
<html>

<head>
    <title>Welcome to the University Student Portal 4.0</title>
</head>

<body>
    <h1>Welcome to University Student Portal 4.0, {{ $user->firstname }}!</h1>
    <p>Thank you for registering with us. We're excited to have you on board.</p>
    <p>Here are your details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ '**-***' . substr($user->student_id, -2) }}</li>
        <li><strong>Your Password is your student ID number.</li>

    </ul>

    <p>Kindly visit https://portal.usm.edu.ph and log in.</p>
    <p>If any of these details are incorrect, please contact us via https://agapay.usm.edu.ph</p>
    <p>Best regards,</p>
    <p>One USM Team</p>
</body>

</html>
