<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Your Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        h1 {
            color: #0073e6;
        }

        p {
            margin-bottom: 20px;
        }

        a.button {
            background-color: #0073e6;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #005bb5;
        }

        .link-text {
            font-family: monospace, sans-serif;
            color: #333;
            font-size: 14px;
            word-wrap: break-word;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            display: block;
            margin-top: 20px;
            word-break: break-all;
        }

        .footer {
            font-size: 12px;
            text-align: center;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Activate Your Account</h1>
        <p>Hi {{ $user->name }},</p>
        <p>Thank you for registering with us. To activate your account and access the admin dashboard, please click the button below:</p>
        
        <a href="{{ $activationLink }}" class="button">Activate Account</a>
        
        <p>If you have trouble clicking the button, you can copy the following link and paste it into your browser:</p>
        
        <p class="link-text">{{ $activationLink }}</p>

        <p>If you did not request this email, please ignore it or contact our support team.</p>
    </div>

    <div class="footer">
        <p>Regards,<br>{{ config('site.name') }}</p>
        <p>For any issues, contact us at <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></p>
    </div>

</body>
</html>
