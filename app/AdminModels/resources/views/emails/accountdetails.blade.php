<!DOCTYPE html>
<html>
<head>
    <title>Welcome to USMCEE 4.0</title>
</head>
<body>
    <h1>Welcome to USMCEE 4.0, {{ $user->firstname }}!</h1>
    <p>Thank you for registering with us. We're excited to have you on board.</p>
    <p>Here are your details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ '*******' . substr($user->phone, -3) }}</li>
        <li><strong>Your Password is your registered phone number.</li>

    </ul>

    <p>Kindly visit https://cee.usm.edu.ph and log in. Complete your profile to reserve a slot.</p>
    <p>If any of these details are incorrect, please contact us via https://agapay.usm.edu.ph</p>
    <p>Best regards,</p>
    <p>USMCEE 4.0 Team</p>
</body>
</html>
