<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="Logo {{ $setting['site_name'] }}" width="44" height="44">
            {{-- Bukan h1: heading utama tiap halaman ada di konten (hero / judul produk) --}}
            <span class="sitename">{{ $setting['site_name'] }}</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ url('/') }}#hero" class="active">Home</a>
                </li>
                <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
                <li><a href="{{ url('/') }}#services">Keunggulan</a></li>
                <li><a href="{{ url('/') }}#pricing">Harga</a></li>
                <li><a href="{{ url('/') }}#produk">Produk</a></li>
                <li><a href="{{ url('/') }}#contact">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" target="_blank" rel="noopener"
            href="{{ \App\Support\WhatsApp::link(trim($setting['whatsapp_message'] . ' layanan ' . $setting['site_name'])) }}">
            <i class="bi bi-whatsapp"></i> <span class="btn-label">Hubungi Kami</span>
        </a>

    </div>
</header>
