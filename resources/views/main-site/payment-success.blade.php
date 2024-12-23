<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h4>Payment Successful</h4>
            <p>Thank you for your purchase, {{ $metadata->name }}!</p>
            <p>An email confirmation has been sent to {{ $customer_email }}.</p>
            <p>If you have any questions, please contact us at support@example.com.</p>
        </div>
    </div>
</body>
</html>
