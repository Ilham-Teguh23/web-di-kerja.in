<aside class="sticky app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ asset('index.html') }}" class="header-logo">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="desktop-logo">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="toggle-logo">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="desktop-dark">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="toggle-dark">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="desktop-white">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Pemisah -->
    <hr class="sidebar-divider">

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">
        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->
    
                <!-- Start::slide -->
                <li class="slide {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fe fe-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <!-- End::slide -->
    
                <!-- Start::slide -->
                <li class="slide {{ request()->routeIs('contact-message.index') ? 'active' : '' }}">
                    <a href="{{ route('contact-message.index') }}" class="side-menu__item {{ request()->routeIs('contact-message.index') ? 'active' : '' }}">
                        <i class="fe fe-message-square side-menu__icon"></i>
                        <span class="side-menu__label">Contact Message</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide {{ request()->routeIs('package-item.index') ? 'active' : '' }}">
                    <a href="{{ route('package-item.index') }}" class="side-menu__item {{ request()->routeIs('package-item.index') ? 'active' : '' }}">
                        <i class="fe fe-package side-menu__icon"></i>
                        <span class="side-menu__label">Paket Item</span>
                    </a>
                </li>
                <!-- End::slide -->
    
                <li class="slide__category">
                    <span class="category-name">Menu</span>
                </li>
    
                <li class="slide has-sub {{ request()->routeIs('testimonials.*', 'faq.*', 'benefit.*', 'katalog.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-users side-menu__icon"></i>
                        <span class="side-menu__label">Master</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('testimonials.index') }}" class="side-menu__item {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">Testimonial</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('faq.index') }}" class="side-menu__item {{ request()->routeIs('faq.*') ? 'active' : '' }}">FAQ</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('benefit.index') }}" class="side-menu__item {{ request()->routeIs('benefit.*') ? 'active' : '' }}">Benefit</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('katalog.index') }}" class="side-menu__item {{ request()->routeIs('katalog.*') ? 'active' : '' }}">Katalog</a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub {{ request()->routeIs('favorite-item.*', 'price-item.*', 'detail-consultant.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-settings side-menu__icon"></i>
                        <span class="side-menu__label">Meta Data</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('favorite-item.index') }}" class="side-menu__item {{ request()->routeIs('favorite-item.*') ? 'active' : '' }}">Favorite Item</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('price-item.index') }}" class="side-menu__item {{ request()->routeIs('price-item.*') ? 'active' : '' }}">Harga Item</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('detail-consultant.index') }}" class="side-menu__item {{ request()->routeIs('detail-consultant.*') ? 'active' : '' }}">Detail Konsultasi</a>
                        </li>
                    </ul>
                </li>
    
                <li class="slide__category">
                    <span class="category-name">Account</span>
                </li>
    
                <li class="slide has-sub {{ request()->routeIs('users.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-users side-menu__icon"></i>
                        <span class="side-menu__label">Akun</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('users.index') }}" class="side-menu__item {{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->
    </div>
    
    <!-- End::main-sidebar -->

</aside>
