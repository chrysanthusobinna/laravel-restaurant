@extends('layouts.auth')

@section('title', 'Activation Link Sent')

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var countdownTime = 60; // 1 minute in seconds

            $('#resend-button').click(function(event) {
                event.preventDefault();
                var button = $(this);

                button.prop('disabled', true);
                $('#countdown-message').text('You can resend the link after ' + countdownTime + ' seconds.');

                var countdownInterval = setInterval(function() {
                    countdownTime--;
                    $('#countdown-message').text('You can resend the link after ' + countdownTime + ' seconds.');

                    if (countdownTime <= 0) {
                        clearInterval(countdownInterval);
                        button.prop('disabled', false);
                        $('#countdown-message').text('');
                    }
                }, 1000); // Update every second

                setTimeout(function() {
                    $('#resend-form').submit();
                }, countdownTime * 1000);
            });
        });
    </script>
@endpush



@section('content')
 
    @include('partials.message-bag')

    <div class="container">
        <h4>Activation Link Sent</h4>

        <p>An activation link has been sent to your email: <strong>{{ $email }}</strong>.</p>
        <p>Please check your inbox and follow the instructions to activate your account.</p>
    
        <p>If you have not received the email within a few minutes, you can resend the link below:</p>
        <hr/>
        <form id="resend-form" action="{{ route('admin.activate.link.request') }}" method="GET">
            <button id="resend-button" class="btn block btn btn-primary" type="submit">Resend Activation Link</button>
        </form>
        <p id="countdown-message"></p>
    </div>
@endsection

 