<div x-data="{ open: false }" class="lg:hidden relative">
    <!-- Open Button -->
    <button @click="open = true" class="canvas-open">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div
        class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform transition-transform duration-300 z-50"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="p-4 flex justify-between items-center border-b">
            <h2 class="text-lg font-bold">Menu</h2>
            <button @click="open = false" class="text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Menu Items -->
        <nav class="p-4">
            <ul class="space-y-4 dropdown">
                <li><a href="#" class="hover:underline">Home</a></li>
                <li><a href="#" class="hover:underline">Rooms</a></li>
                <li><a href="#" class="hover:underline">About Us</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
            </ul>
        </nav>
    </div>
</div>


<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fas fa-phone"></i> (+94) 74 137 5941</li>
                        <li><i class="fas fa-envelope"></i> FourSeasons@gmail.comm</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <a href="{{ route('rooms') }}" class="bk-btn">Booking Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img class="logo-header" src="{{ asset('images/logo5.png') }}" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul class="space-y-2">
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="{{ request()->routeIs('rooms') ? 'active' : '' }}">
                                    <a href="{{ route('rooms') }}">Rooms</a>
                                </li>
                                <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a href="{{ route('cart.index') }}">        
                                        <button type="button" class="position-relative">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                                                3
                                            </span>
                                        </button>                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
