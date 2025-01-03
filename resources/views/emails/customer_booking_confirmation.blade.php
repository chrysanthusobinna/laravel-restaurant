<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Table Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
            background-color: #000; /* Ensure a contrasting background */
            padding: 10px;
            border-radius: 5px;
        }

        .logo img {
            max-width: 150px;
        }

        h1 {
            color: #0056b3;
            text-align: left;
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
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ config('site.url').'assets/images/logo_light.png' }}" alt="Logo">
        </div>

        <!-- Greeting -->
        <h1>Your Table Booking Confirmation</h1>

        <!-- Booking Details -->
        <p>Dear {{ $booking->name }},</p>
        <p>Your table booking has been confirmed:</p>
        <ul>
            <li><strong>Date:</strong> {{ $booking->date }}</li>
            <li><strong>Time:</strong> {{ $booking->time }}</li>
            <li><strong>Persons:</strong> {{ $booking->persons }}</li>
        </ul>
        <p>If you need to make any changes or have any questions, please contact us.</p>
        <p><strong>Email:</strong> {{ config('site.email') }}</p>
 
        <!-- Footer -->
        <div class="footer">
            <hr>
            <p>Regards,<br>{{ config('site.name') }}</p>
        </div>
    </div>
</body>
</html>
