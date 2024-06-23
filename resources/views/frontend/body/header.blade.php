<style>
    .highlighted-text {
        /* background-color: ; */
        font-weight: bold;
        color: rgb(135, 135, 42);
    }

    .moving-text {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        box-sizing: border-box;
        animation: marquee 10s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>


<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-2 pr-0">

                <span class="mt-3 moving-text highlighted-text">This WebSite Created By - Imran Mallik Only Practice
                    Purpose</span>
            </div>

            <div class="col-lg-9 col-md-10">



                <div class="header-right">
                    <ul>
                        <li>
                            <i class="bx bx-home-alt"></i>
                            <a href="#">123 Virgil A Stanton, Virginia, USA</a>
                        </li>
                        @auth
                            <li>
                                <i class="bx bxs-user-pin"></i>
                                <a href="{{ route('dashboard') }}">Dashboadrd</a>
                            </li>
                            <li>
                                <i class="bx bxs-user-rectangle"></i>
                                <a href="{{ route('user.logout') }}">Logout</a>
                            </li>
                        @else
                            <li>
                                <i class="bx bxs-user-pin"></i>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li>
                                <i class="bx bxs-user-rectangle"></i>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
