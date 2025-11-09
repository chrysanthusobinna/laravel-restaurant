<div class="account_box">
    <div class="account_box_header">
        <h3>
            @auth
                Hi, {{ Auth::user()->first_name }}
            @else
                Account
            @endauth
        </h3>
    </div>
    <hr/>
    <div class="account_box_body">
        @guest
            <ul class="cart_list">
                <li><a href="{{ route('auth.login') }}">Login</a></li>
                <li><a href="{{ route('customer.account.create') }}">Register</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
        @else
            <ul class="cart_list">
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'global_admin')
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @elseif (Auth::user()->role === 'customer')
                    <li><a href="{{ route('customer.account') }}">My Account</a></li>
                    <li><a href="">My Orders</a></li>
                    <li><a href=" ">Change Password</a></li>

                @endif
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
        @endauth
    </div>
</div>
