<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Stripe Payment</h1>
    <form id="payment-form">
        <div id="card-element"><!-- Stripe Element will be inserted here --></div>
        <button id="submit">Pay</button>
        <div id="error-message"></div>
    </form>

    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            submitButton.disabled = true;

            const { paymentIntent, error } = await stripe.confirmCardPayment("{{ config('services.stripe.secret') }}", {
                payment_method: {
                    card: cardElement,
                },
            });

            if (error) {
                errorMessage.textContent = error.message;
                submitButton.disabled = false;
            } else {
                alert('Payment successful!');
                // Redirect or update the page as needed
            }
        });
    </script>
</body>
</html>
