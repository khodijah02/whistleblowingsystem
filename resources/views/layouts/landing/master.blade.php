<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="mekanisme penyampaian pengaduan dugaan tindak pidana tertentu yang telah terjadi atau akan terjadi yang melibatkan pegawai dan orang lain yang yang dilakukan dalam organisasi tempatnya bekerja, dimana pelapor bukan merupakan bagian dari pelaku kejahatan yang dilaporkannya.">
    <meta name="keywords" content="whistleblowing system, rsud kota bogor, whistleblowing rsud kota bogor, pengaduan rsud kota bogor, laporan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WBS RSUD KOTA BOGOR</title>
    @stack('before-style')
    @include('layouts.landing.css')
    @stack('after-style')
  </head>
  <body class="landing-page d-flex flex-column justify-content-between" style="min-height: 100vh">
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{route('complaint.index')}}" class="logo d-flex align-items-center">
                <img src="{{asset('assets/images/logo/logo-rsud.png')}}" alt="">
                <span>Whistleblowing</span>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                <li><a class="nav-link {{ Route::currentRouteName() == 'complaint.index' ? 'active' : '' }}" href="{{ route('complaint.index') }}">Beranda</a></li>
                <li><a class="nav-link {{ Route::currentRouteName() == 'complaint.create' ? 'active' : '' }}" href="{{ route('complaint.create') }}">Pengaduan</a></li>
                <li><a class="nav-link {{ Route::currentRouteName() == 'complaint.show' ? 'active' : '' }}" href="{{ route('complaint.show') }}">Cari</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer id="footer" class="footer mt-5">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>RSUD Kota Bogor</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="">RSUD Kota Bogor</a>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    @stack('before-script')
    @include('layouts.landing.script')
    @stack('after-script')
  </body>
</html>
