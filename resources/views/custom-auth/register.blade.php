@extends('mainBefore')
 @section('content')
 <section class="page-container">

    <section class="body">
        <div class="login-page-boxes">
            @isset($disabledError)
            <p>{{ $disabledError }}</p>
                
            @endisset
            <!-- Login Form -->
            <div class="accountform login-box">
                <h1 class="accountform-banner">Log in</h1>
                <form action="{{ route('login') }}" method="POST" class="loginform">
                    @csrf
                    <div class="accountform-field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text" value="" autofocus
                            required>
                    </div>
                    <div class="accountform-field">
                        <label for="password">Password<a href="{{ route('password.request') }}"
                                class="accountform-helplink-tiny" tabindex="-1">Forgot password?</a></label>
                        <input id="password" type="password" name="password">
                    </div>
                    <div class="accountform-actions">
                        
                        <button type="submit" id="login" class="accountform-btn">Log in</button>
                    </div>
                </form>
            </div>

            <p class="box-conjunction">
                or
            </p>

            <!-- Register Form -->
            <div class="accountform login-page-box create-account-box">
                <h1 class="accountform-banner">Create an account</h1>
                <form action="{{ route('cust-register') }}" method="POST" class="signupform">
                    @csrf
                    <div class="accountform-field">
                        <label for="email">Email</label>
                        <input id="email" maxlength="64" name="email" type="email" value="" required>
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                        <label for="password">Password</label>
                        <input id="password" maxlength="64" name="password" type="password" value="" required>
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                        <label for="password_confirmation"> Password Confirmation</label>
                        <input id="password_confirmation" maxlength="64" name="password_confirmation" type="password" value="" required>
                        @error('password_confirmation')
                            <p>{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="accountform-actions">
                        <button type="submit" id="create" class="accountform-btn">Create account</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>
 @endsection