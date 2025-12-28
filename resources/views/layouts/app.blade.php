<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ACE Lombok') }}</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FLOWBITE (opsional untuk UI siap pakai) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- FONT: GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <!-- BOOTSTRAP CSS -->
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    .navbar-custom {
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }
    .navbar-brand img {
        height: 55px;
    }
    .org-text {
        line-height: 1.1;
        font-size: 13px;
        margin-left: 10px;
    }
    .nav-link {
        font-size: 13px;
        color: #1f2a44 !important;
        padding: 0 12px !important;
        font-weight: 600;
    }
    .btn-anggota {
        background: #1e324c;
        color: white;
        padding: 18px 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 0;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white navbar-custom">
    <div class="container">

        <!-- Logo + Text -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="http://127.0.0.1:8000/images/logoace.png">
            <div class="org-text">
                <b>ASOSIASI CHIEF ENGINEER LOMBOK</b><br>
                BALI CHIEF ENGINEERS ASSOCIATION
            </div>
        </a>

        <!-- Button Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">

                <li><a class="nav-link" href="/">HOME</a></li>
                <li><a class="nav-link" href="#">ABOUT</a></li>

                <!-- Dropdown STRUKTUR -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">STRUKTUR ORGANISASI</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Dewan Pembina</a></li>
                        <li><a class="dropdown-item" href="#">Pengurus</a></li>
                    </ul>
                </li>

                <li><a class="nav-link" href="#">GALLERY</a></li>

                <!-- Dropdown EVENT -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">EVENT</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Kegiatan</a></li>
                        <li><a class="dropdown-item" href="#">Pelatihan</a></li>
                    </ul>
                </li>

                <li><a class="nav-link" href="#">ARTIKEL</a></li>
                <li><a class="nav-link" href="#">LOWONGAN</a></li>
                <li><a class="nav-link" href="#">MITRA KAMI</a></li>

                <!-- Tombol Kanan -->
                <li class="ms-3">
                    <a class="btn btn-anggota" href="#">DAFTAR ANGGOTA</a>
                </li>
            </ul>
        </div>
        <div class="dropdown ms-auto text-right">
            <button class="btn dropdown-toggle text-decoration-none" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle fa-lg" style="width: 30px; height: 30px"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/login"><i class="fas fa-door-open"></i> Login</a></li>
                <li><a class="dropdown-item" href="/logout"><i class="fas fa-door-closed"></i> Logout</a></li>
            </ul>
        </div>

    </div>
</nav>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-white text-gray-900">

    {{-- NAVBAR --}}

    {{-- CONTENT --}}
    <div class="pt-20">
        @yield('content')
    </div>

    <!--{{-- FOOTER --}}
    <footer class="mt-20 bg-gray-900 text-white py-10">
        <div class="container mx-auto px-5 text-center">
            <p>&copy; {{ date('Y') }} Ace Lombook Experience. All rights reserved.</p>
        </div>
    </footer>-->

    <!-- FLOWBITE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>
