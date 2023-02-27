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
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">


</head>

<body>

    {{-- side bar start  --}}
    <div class="side-bar float-start shadow pe-3" style="width: 299px;height: 980px">
        <h2 class=" mt-5" style="margin-left: 70px"><span class="text-info">e</span><span
                class="text-muted">Toolz</span></h2>
        <ul class="mt-5" style="list-style: none">
            <li class="mb-3">
                <a href="{{ route('admin#categoryListPage') }}">
                    <button class="btn  py-3 w-100 ">
                        <span class="me-5 ">
                            <i class="fa-solid fa-clone me-4 text-muted" style="font-size: 24px;">
                            </i>
                            <div class="fw-bold text-muted d-inline-block" style="font-size: 23px;width:105px ">Category
                            </div>
                        </span>
                    </button>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('admin#productsPage') }}">
                    <button class="btn py-3 w-100 ">
                        <span class="me-5 ">
                            <i class="fa-solid fa-box me-4 text-muted" style="font-size: 24px;">
                            </i>
                            <div class="fw-bold text-muted d-inline-block" style="font-size: 23px;width:105px">Products
                            </div>
                        </span>
                    </button>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('admin#ordersList') }}">
                <button class="btn  py-3 w-100 ">
                    <span class="ms-1 me-5">
                        <i class="fa-solid fa-cart-flatbed text-muted me-4" style="font-size: 24px"></i>
                        <div class="fw-bold text-muted d-inline-block" style="font-size: 23px;width:105px"> Orders
                        </div>
                    </span>
                </button>
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('admin#orderLists') }}">
                <button class="btn py-3 w-100 ">
                    <span class="ms-1 me-5">
                        <i class="fa-solid fa-list text-muted me-4" style="font-size: 24px;"></i>
                        <div class="fw-bold text-muted d-inline-block" style="font-size: 23px;width:120px"> Order
                            lists
                        </div>
                    </span>
                </button>
                </a>
            </li>
            <li class="mb-3"><a href="{{ route('admin#messageList') }}" class="">
                    <button class="btn py-3 w-100 ">
                        <span class=" me-5">
                            <i class="fa-solid fa-envelope me-4 text-muted" style="font-size: 24px"></i>
                            <div class="fw-bold text-muted d-inline-block" style="font-size: 23px;width:105px">
                                Message
                            </div>
                        </span>
                    </button></a>
            </li>
        </ul>
    </div>
    {{-- side bar end  --}}

    {{-- top nav bar start --}}
    <div class=" d-flex align-items-center py-3 justify-content-between shadow-sm">
        <div class="d-flex align-items-center">
            <div class="toggle-btn">
                <button class="btn  " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <h4 class="mini-header "><span class="text-info">e</span><span class="text-muted">Toolz</span></h4>
        </div>
        <div class="">

            <div class="dropdown">
                <button class="dropdown-button">
                    @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                        <img src="{{ asset('image/default_male.webp') }}" style="width: 45px;height:45px"
                            class="rounded-circle" alt="">
                    @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                        <img src="{{ asset('image/default_female.jpg') }}" style="width: 45px;height:45px"
                            class="rounded-circle" alt="">
                    @else
                        <img src="{{ asset('storage/image/profileImages/' . Auth::user()->image) }}" style="width: 45px;height:45px"
                            alt="" class="rounded-circle" srcset="">
                    @endif
                    <i class="fa-solid fa-angle-down ms-2"></i>
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('admin#profilePage') }}"
                        class="d-block text-decoration-none text-secondary text-start ps-4 py-2"
                        style="font-size: 17px"><span class="d-block" style="font-size: 18px">Signed in as</span><span
                            class="d-inline-block fw-bold text-info">{{ Auth::user()->name }}</span></a>
                    <a href="{{ route('admin#profilePage') }}"
                        class="d-block text-decoration-none text-secondary text-start ps-4 py-2"
                        style="font-size: 17px"><i class="fa-solid fa-user me-2"></i><span>Profile</span></a>
                    <a href="{{ route('admin#passwordChangePage') }}"
                        class="d-block text-decoration-none text-secondary text-start ps-4 py-2"
                        style="font-size: 17px"><i class="fa-solid fa-lock me-2"></i><span>Change Password</span></a>
                    <a href="{{ route('admin#adminsListPage') }}" class="d-block text-decoration-none text-secondary text-start ps-4 py-2"
                        style="font-size: 17px"><i class="fa-solid fa-users me-2"></i><span>Admins List</span></a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger ms-4 mt-1">
                            <i class="fa-solid fa-right-from-bracket me-2"></i><span>Log Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel" style="width: 240px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasEx"><span class="text-info">e</span><span
                    class="text-muted">Toolz</span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-3">
                <a href="{{ route('admin#categoryListPage') }}">
                    <button class="btn btn-light pe-5 w-100"><i class="fa-solid fa-clone me-2 text-muted"
                            style="font-size: 20px;">
                        </i>
                        <div class="text-muted d-inline-block" style="width: 80px">Category</div>
                    </button>
                </a>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin#productsPage') }}">
                    <button class="btn btn-light pe-5 w-100"><i class="fa-solid fa-box me-2 text-muted"
                            style="font-size: 20px;">
                        </i>
                        <div class="text-muted d-inline-block" style="width: 80px">Products</div>
                    </button>
                </a>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin#ordersList') }}">
                    <button class="btn btn-light pe-5 w-100"><i class="fa-solid fa-cart-flatbed me-2 text-muted"
                            style="font-size: 20px;">
                        </i>
                        <div class="text-muted d-inline-block" style="width: 80px">Orders</div>
                    </button>
                </a>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin#orderLists') }}">
                    <button class="btn btn-light pe-5 w-100"><i class="fa-solid fa-list me-2 text-muted"
                            style="font-size: 20px;">
                        </i>
                        <div class="text-muted d-inline-block" style="width: 80px">Orders list</div>
                    </button>
                </a>
            </div>
            <div class="mb-3">
                <a href="{{ route('admin#messageList') }}">
                    <button class="btn btn-light pe-5 w-100"><i class="fa-solid fa-envelope me-2 text-muted"
                            style="font-size: 20px;">
                        </i>
                        <div class="text-muted d-inline-block" style="width: 80px">Message</div>
                    </button>
                </a>
            </div>
        </div>
    </div>
    {{-- top nav bar end  --}}
    <div id="app">
        @yield('content')
    </div>

 @vite('resources/js/app.js')
</body>





{{-- bootstrap link  --}}
<script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>

</html>
