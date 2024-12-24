<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <img src="{{ url('/landing-page') }}/assets/img/logo.png" alt="">
            <h1 class="sitename">di.kerja.in</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ url('/') }}#hero" class="active">Home</a>
                </li>
                <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
                <li><a href="{{ url('/') }}#services">Keunggulan</a></li>
                <li><a href="{{ url('/') }}#pricing">Harga</a></li>
                <li><a href="{{ url('/') }}#contact">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
