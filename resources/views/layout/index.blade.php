@include('layout.partials.mainhead')

<head>
<!-- Jsvector Css -->
<link rel="stylesheet" href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}">

<!-- Swiper Css -->
<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

<!-- Grid Css -->
<link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">

<style>
    .main-sidebar-header .header-logo img {
        width: 75px;
        height: 75px;
        object-fit: contain;
        margin: 0 auto; /* Jika ingin memusatkan gambar */
        display: block; /* Untuk memastikan gambar tidak overlap */
        padding: auto !important;
    }

    /* Pemisah garis */
.sidebar-divider {
    border: none; /* Hilangkan border default */
    border-top: 1px solid #dcdcdc; /* Garis horizontal */
    margin: 50px 0; /* Jarak atas dan bawah */
    width: 90%; /* Panjang garis */
    margin-left: auto; /* Pusatkan garis */
    margin-right: auto; /* Pusatkan garis */
}

/* Styling untuk logo */
.main-sidebar-header {
    display: flex;
    justify-content: center; /* Pusatkan logo secara horizontal */
    align-items: center; /* Pusatkan logo secara vertikal */
    padding: 20px 0; /* Tambahkan padding atas dan bawah */
    background-color: #f8f9fa; /* Warna latar belakang header */
}

/* Styling untuk menu navigasi */
.main-sidebar {
    padding-top: 15px; /* Jarak antara pemisah dan menu */
}

.main-menu-container ul {
    list-style: none; /* Hilangkan bullet list */
    padding: 0; /* Hilangkan padding */
    margin: 0; /* Hilangkan margin */
}

.main-menu .slide {
    margin-bottom: 10px; /* Tambahkan jarak antar item menu */
}

@media (max-width: 768px) {
    .main-sidebar-header {
        padding: 15px 0; /* Kurangi padding di layar kecil */
    }

    .sidebar-divider {
        margin: 10px 0; /* Kurangi jarak garis pemisah */
    }

    .main-menu .slide {
        margin-bottom: 8px; /* Kurangi jarak antar menu */
    }
}

</style>
</head>

<body>

    @include('layout.partials.switcher')
    @include('layout.partials.loader')

    <div class="page">
        <header class="app-header">
            <!-- main-header -->
            @include('layout.partials.header')
            <!-- /main-header -->
        </header>
        @include('layout.partials.sidebar')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- breadcrumb -->
                @yield('breadcumb')
                <!-- /breadcrumb -->

                <!-- row -->
                @yield('content')
                <!-- row closed -->
            </div>
        </div>
        <!-- End::app-content -->

        @include('layout.partials.footer')

    </div>

    @include('layout.partials.commonjs')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JSVector Maps JS -->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Chartjs Chart JS -->
    <script src="{{ asset('assets/libs/chart.js/chart.min.js') }}"></script>

    <!-- index -->
    <script src="{{ asset('assets/js/index.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentUrl = window.location.href;
            var navLinks = document.querySelectorAll('.side-menu__item');

            navLinks.forEach(function(link) {
                var linkUrl = link.getAttribute('href');

                if (currentUrl.indexOf(linkUrl) !== -1) {
                    link.classList.add('active');
                    var parentSubMenu = link.closest('.slide-menu');
                    if (parentSubMenu) {
                        var parentMenu = parentSubMenu.parentElement.closest('.slide');
                        if (parentMenu) {
                            parentMenu.classList.add('active');
                            parentSubMenu.classList.add('show');
                        }
                    }
                }
            });
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke route logout jika pengguna menekan tombol "Ya, Logout!"
                    window.location.href = '{{ route("logout") }}';
                }
            });
        }

        function openSubMenus() {
            var currentUrl = window.location.href;
            var navLinks = document.querySelectorAll('.side-menu__item');

            navLinks.forEach(function(link) {
                var linkUrl = link.getAttribute('href');

                if (currentUrl.indexOf(linkUrl) !== -1) {
                    var parentMenu = link.closest('.has-sub');
                    while (parentMenu) {
                        var subMenu = parentMenu.querySelector('.slide-menu');
                        if (subMenu) {
                            subMenu.classList.add('show');
                        }
                        parentMenu = parentMenu.parentElement.closest('.has-sub');
                    }
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            openSubMenus();
        });
    </script>


    @include('layout.partials.custom_switcherjs')

    @yield('script')
    <!-- Custom JS -->

</body>

</html>
