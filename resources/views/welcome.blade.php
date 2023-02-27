<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- bootstrap css link  --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    {{-- fontawesome link  --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    {{-- css link  --}}
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
</head>

<body>

    {{-- top nav bar open  --}}
    <div class="row py-3 px-3">
        <a href="{{ route('dashboard') }}" class="col-1 text-decoration-none">
            <h4><span class="text-info">e</span><span class="text-secondary">Toolz</span></h4>
        </a>
        <ul class="text-uppercase list-unstyled d-flex gap-3 col-5 mt-1 text-dark" style="font-size: 14px">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <li>Home</li>
            </a>
            <a href="{{ route('user#aboutUsPage') }}" class=" text-decoration-none text-dark">
                <li>About</li>
            </a>
            <a href="{{ route('user#message') }}" class="text-decoration-none text-dark">
                <li>contact us</li>
            </a>
            <a href="{{ route('user#servicePage') }}" class="text-decoration-none text-dark"><li>Services</li></a>
        </ul>
        <div class="col-2 offset-4 text-end">
            <div class="dropdown">
                <button class="dropdown-button btn">
                    <i class="fa-solid fa-user"></i>
                </button>
                <div class="dropdown-content py-2 px-2">

                    @if (Route::has('login'))
                        @auth
                            <ul class=" list-unstyled">
                                <li class="text-start ms-2 mb-1">
                                    <div class="">Signed in as</div>
                                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                                </li>
                                <li class="text-start"><a href="{{ route('user#editProfile') }}" class="btn text-decoration-none  "
                                        style="font-size: 13px">Account details</a></li>
                                <li>
                                    <li class="text-start"><a href="{{ route('user#passwordChangePage') }}" class="btn text-decoration-none"
                                        style="font-size: 13px">Change password</a></li>
                                <li>
                                <li class="text-start"><a href="{{ route('user#notiOrder') }}"
                                        class="btn text-decoration-none  " style="font-size: 13px">Orders</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="">
                                        @csrf
                                        <div class="text-start"><button class="btn "
                                                style="font-size: 13px">Logout</button></div>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('login') }}" class="d-block text-decoration-none text-secondary text-start "
                                style="font-size: 14px"><span class="loginBtn">Login</span></a>
                            <a href="{{ route('register') }}"
                                class="d-block text-decoration-none text-secondary text-start "
                                style="font-size: 14px"><span class="registerBtn">Register</span></a>

                        @endauth
                    @endif
                </div>
            </div>
            <a href="{{ route('user#notiMessage') }}" class=" text-decoration-none">
                <button class="btn">
                    <i class="fa-solid fa-bell"></i>
                </button>
            </a>
            <a href="{{ route('user#cartList') }}" class=" text-decoration-none">
                <button class="btn">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </a>
        </div>
    </div>
    {{-- top nav bar close  --}}

    <div id="app">
        @yield('content')
    </div>

    {{-- bottom open  --}}

    <div class="row" style="margin-top: 100px;background-color: #f8f5f5;padding: 20px 100px;">
        <div class="col-1">
            <h4 class=""><span class="text-info">e</span><span class="text-secondary">Toolz</span></h4>
        </div>
        <div class="col-3 offset-1">
            <h6 class="mb-3">Company</h6>
            <ul class="list-unstyled text-secondary" style="font-size: 15px">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                    <li>Home</li>
                </a>
                <a href="{{ route('user#aboutUsPage') }}" class=" text-decoration-none text-dark">
                    <li>About</li>
                </a>
                <a href="{{ route('user#message') }}" class="text-decoration-none text-dark">
                    <li>contact us</li>
                </a>
                <a href="{{ route('user#servicePage') }}" class="text-decoration-none text-dark"><li>Services</li></a>
            </ul>
        </div>
        <div class="col-3">
            <h6 class="mb-3">Follow us on the internet</h6>
            <ul class="list-unstyled text-secondary" style="font-size: 15px">
                <li class="mb-1">Instagram</li>
                <li class="mb-1">Facebook</li>
                <li class="mb-1">Twitter</li>
                <li class="mb-1">Tiktok</li>
                <li>LinkedIn</li>
            </ul>
        </div>
        <div class="col-3">
            <h6 class="mb-4">Subscribe for 10% off for first item purchase.</h6>
            <div class="d-flex gap-2">
                <input style='border-radius: 3px;border: 1px solid #D3D3D3;' class="py-2 px-1" type="text"
                    name="" id="" placeholder="Enter your email address">
                <button class="btn text-white fw-bold" style="background-color: blue">Subscribe</button>
            </div>
        </div>
    </div>

    <div class="text-center">
        Copyright 2023.All rights reserved.
    </div>


    {{-- bottom close  --}}

    @vite('resources/js/app.js')
</body>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>
