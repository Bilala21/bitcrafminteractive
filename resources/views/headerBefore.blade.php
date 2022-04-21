<header class="global-header simple">
    <nav class="breadcrumbs-container user__nav">
        <div class="d-flex">
            <a class="header-logo" name="logoLink" href="#">MI</a>
            <ul class="breadcrumbs">
                <li class="crumb plain-message">
                    <a href="{{ route('home') }}" class="add_coupon ancher_style">Home</a>
                </li>
                <li class="crumb plain-message">
                        @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="ancher_style">Logout</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="add_coupon ancher_style">Login</a>
                        @endauth
                    
                </li>
            </ul>
        </div>
        <div class="current__user__email">
            <a href="{{ route('user') }}" class="ancher_style">
            </a>
        </div>
    </nav>
</header>