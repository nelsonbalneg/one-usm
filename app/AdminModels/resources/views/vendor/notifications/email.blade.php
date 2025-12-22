<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password Notification</title>
    <style type="text/css">
        /* Add your CSS styles here */
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f9f9f9; color: #000000;">
    <table style="width: 100%; background-color: #f9f9f9;">
        <tr>
            <td align="center">
                <div style="max-width: 600px; background-color: #ffffff; margin: 0 auto;">
                    <!-- Logo Section -->
                    <table style="width: 100%; background-color: #ebeaea; padding: 20px;">
                        <tr>
                            <td align="center">
                                <img src="https://assets.unlayer.com/projects/255869/1730868152983-USM-CEE.png"
                                    alt="USM CEE Logo" style="max-width: 100%; height: auto;">
                            </td>
                        </tr>
                    </table>

                    <!-- Greeting Section -->
                    <table style="width: 100%; background-color: #0c490b; padding: 10px;">
                        <tr>
                            <td align="center">
                                <h2 style="color: #e5eaf5;">
                                    Reset Password Notification
                                </h2>
                            </td>
                        </tr>
                    </table>

                    <!-- Intro Section -->
                    <table style="width: 100%; padding: 33px 55px;">
                        <tr>
                            <td>
                                @foreach ($introLines as $line)
                                    <p style="font-size: 18px; color: #333333;">{{ $line }}</p>
                                @endforeach
                            </td>
                        </tr>
                    </table>

                    <!-- Action Button Section -->
                    @isset($actionUrl)
                                        <?php
                        $buttonColor = $level === 'success' ? '#28a745' : ($level === 'error' ? '#dc3545' : '#424242');
                                                                                    ?>
                                        <table style="width: 100%; padding: 10px;">
                                            <tr>
                                                <td align="center">
                                                    <a href="{{ $actionUrl }}"
                                                        style="background-color: {{ $buttonColor }}; color: #FFFFFF; padding: 14px 44px; text-decoration: none; border-radius: 4px; display: inline-block;">
                                                        {{ $actionText ?? 'Reset Password' }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                    @endisset

                    <!-- Outro Section -->
                    <table style="width: 100%; padding: 33px;">
                        <tr>
                            <td>
                                @foreach ($outroLines as $line)
                                    <p style="font-size: 18px; color: #333333;">{{ $line }}</p>
                                @endforeach
                            </td>
                        </tr>
                    </table>

                    <!-- Subcopy Section -->
                    @isset($actionText)
                        <table style="width: 100%; padding: 41px 55px;">
                            <tr>
                                <td>
                                    <p style="font-size: 14px; color: #666666;">
                                        @lang("If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n" . 'into your web browser:', ['actionText' => $actionText])
                                        <br>
                                        <a href="{{ $actionUrl }}"
                                            style="color: #0000ee;">{{ $displayableActionUrl ?? $actionUrl }}</a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    @endisset

                    <!-- Footer Section -->
                    <table style="width: 100%; background-color: #f7ff00; padding: 10px;">
                        <tr>
                            <td align="center">
                                <p style="font-size: 16px; color: #000000;">
                                    Copyright © University of Southern Mindanao. All Rights Reserved.
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
