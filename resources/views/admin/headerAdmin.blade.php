<header class="global-header simple">
    <a class="header-logo" name="logoLink" href="#">MI</a>

    <nav class="breadcrumbs-container">

        <ul class="breadcrumbs">
            <li class="crumb plain-message">
                <a href="{{ route('admin') }}" class="add_coupon">Home</a>
            </li>
            <li class="crumb plain-message">
                    @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="user-header-logout">Logout</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="add_coupon">Login</a>
                    @endauth
                
            </li>
        </ul>
    </nav>
</header>