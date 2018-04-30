<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
    <link rel="stylesheet" href="/css/themestyle.css">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <title>Geziyorum @if ($__env->yieldContent('title'))- @yield('title') @endif</title>
</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="row inside">
                <div class="logo">
                    <a href="{{ route('homepage') }}">
                        <img src="/images/logo.png" alt="">
                    </a>
                </div>
                <nav>
                    <div class="mobile-nav hidden-md-up"></div>
                    <div class="desktop-nav">
                        <ul>
                            <li>
                                <a href="#">menu</a>
                            </li>
                            <li>
                                <a href="#">menu</a>
                            </li>
                            <li>
                                <a href="#">menu</a>
                            </li>
                            <li>
                                <a href="#">menu</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                @guest
                    <div class="user-area">
                        <a href="{{ route('login') }}" title="Login">
                            <div>
                                <i class="fas fa-user"></i>
                            </div>
                        </a>
                        <a href="{{ route('register') }}" title="Register">
                            <div>
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('panel') }}">Your Trips</a>
                            <a class="dropdown-item" href="{{ route('panel') }}">Edit Account</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>
    @yield('main')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul>
                        <li class="title">
                            About
                        </li>
                        <li>
                            <a href="">About Geziyorum</a>
                        </li>
                        <li>
                            <a href="">Contact</a>
                        </li>
                        <li>
                            <a href="">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="">Copyright</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li class="title">
                            Travel Tips
                        </li>
                        <li>
                            <a href="">Start Here</a>
                        </li>
                        <li>
                            <a href="">Destination Guides</a>
                        </li>
                        <li>
                            <a href="">How to Use Geziyorum</a>
                        </li>
                        <li>
                            <a href="">Life &amp; Travel</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li class="title">
                            Resources
                        </li>
                        <li>
                            <a href="">Suggested Companies</a>
                        </li>
                        <li>
                            <a href="">Books &amp; Guides</a>
                        </li>
                        <li>
                            <a href="">Book Club</a>
                        </li>
                        <li>
                            <a href="">Travel Insurance</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li class="title">
                            Follow us
                        </li>
                        <li>
                            <a href="">
                                <i class="fab fa-facebook"></i> /geziyorum</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fab fa-youtube"></i> /geziyorum</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fab fa-instagram"></i> @geziyorum</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fab fa-twitter"></i> @geziyorum</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script>
        var mobile_nav_toggle = document.getElementsByClassName('mobile-nav-toggle')[0];
        var mobile_nav = document.getElementsByClassName('mobile-nav')[0];

        mobile_nav_toggle.onclick = function () {
            if (mobile_nav.classList.contains('hide')) {
                mobile_nav.classList.remove('hide');
            } else {
                mobile_nav.classList.add('hide');
            }
        }
    </script>
</body>
</html>