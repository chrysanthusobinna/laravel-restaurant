<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Account Notification</title>
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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
        }

        h1 {
            color: #0073e6;
            font-size: 22px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .alert {
            background-color: #ff6347;
            color: white;
            padding: 10px 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        table td {
            background-color: #ffffff;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }

        .footer hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ config('site.url') . 'assets/images/logo_light.png' }}" alt="Logo">
        </div>

        <!-- Greeting -->
        <h1>Welcome, {{ $user->name }},</h1>

        <!-- Introduction -->
        <p><strong>{{ config('site.name') }} - Your New Account</strong></p>
        <p>An account has been created for you on {{ config('site.name') }}.</p>

        <!-- Alert -->
        <div class="alert">Please use the following credentials to log in</div>

        <!-- Credentials -->
        <table>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Password</th>
                <td>{{ $password }}</td>
            </tr>
            <tr>
                <th>Login Link</th>
                <td><a href="{{ route('admin.login') }}">{{ route('admin.login') }}</a></td>
            </tr>
        </table>

        <p><strong>Important:</strong> A confirmation code will be sent to you when you try to log in for the first time. Use this one-time password to change your password and gain access to the admin panel.</p>

        <!-- Footer -->
        <div class="footer">
            <hr>
            <p>If you believe this email is not intended for you, please kindly ignore it or contact us at <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.</p>
            <p>Regards,<br>{{ config('site.name') }}</p>
        </div>
    </div>

</body>
</html>
