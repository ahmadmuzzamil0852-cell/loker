<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Gudang Kerinci')
    </title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>

        :root{
            --hijau-tua:#2d6a2d;
            --hijau-muda:#4caf50;
            --cokelat:#795548;
            --krem:#fdf6ec;
        }

        body{
            background-color:var(--krem);
            font-family:'Segoe UI',sans-serif;
        }

        .navbar{
            background-color:var(--hijau-tua)!important;
        }

        .navbar .nav-link{
            color:white!important;
            font-weight:500;
        }

        .navbar .nav-link:hover{
            opacity:.8;
        }

        .btn-kerinci{
            background-color:var(--hijau-tua);
            color:white;
            border:none;
        }

        .btn-kerinci:hover{
            background-color:var(--hijau-muda);
            color:white;
        }

        .badge-kategori{
            background-color:var(--cokelat);
            color:white;
            padding:4px 10px;
            border-radius:20px;
        }

        .btn-logout{
            background:none;
            border:none;
            padding:8px;
            color:white!important;
            font-weight:500;
        }

        .btn-logout:hover{
            opacity:.8;
        }

        footer{
            background:#2d6a2d;
            color:white;
        }

    </style>

    @yield('styles')

</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="{{ route('home') }}">

            Gudang Kerinci

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#nav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="nav">

            <ul class="navbar-nav ms-auto align-items-center">

                {{-- HOME --}}
                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('home') }}">

                        Home

                    </a>

                </li>

                {{-- KATALOG --}}
                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('produk.index') }}">

                        Katalog

                    </a>

                </li>

                {{-- ========================= --}}
                {{-- MENU KHUSUS USER --}}
                {{-- ========================= --}}

                @if(session('role') == 'user')

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('transaksi') }}">

                            Transaksi Saya

                        </a>

                    </li>

                @endif

                {{-- ========================= --}}
                {{-- MENU KHUSUS ADMIN --}}
                {{-- ========================= --}}

                @if(session('role') == 'admin')

                    {{-- KELOLA PRODUK --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('admin.produk') }}">

                            Kelola Produk

                        </a>

                    </li>

                    {{-- KELOLA NEGO --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('nego.index') }}">

                            Kelola Nego

                        </a>

                    </li>

                    {{-- DATA TRANSAKSI --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('admin.transaksi') }}">

                            Data Transaksi

                        </a>

                    </li>

                    {{-- LAPORAN --}}
                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('admin.laporan') }}">

                            <i class="bi bi-file-earmark-bar-graph me-1"></i>

                            Laporan

                        </a>

                    </li>

                @endif

                {{-- ========================= --}}
                {{-- LOGIN DAN LOGOUT --}}
                {{-- ========================= --}}

                @if(session('login'))

                    <li class="nav-item">

                        <span class="nav-link">

                            Hi,
                            {{ session('role', 'User') }}

                        </span>

                    </li>

                    {{-- LOGOUT POST --}}
                    <li class="nav-item">

                        <form action="{{ route('logout') }}"
                              method="POST"
                              class="m-0">

                            @csrf

                            <button type="submit"
                                    class="btn-logout">

                                <i class="bi bi-box-arrow-right me-1"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                @else

                    <li class="nav-item">

                        <a class="nav-link"
                           href="{{ route('login') }}">

                            Login

                        </a>

                    </li>

                @endif

            </ul>

        </div>

    </div>

</nav>

{{-- CONTENT --}}
<main class="py-4">

    <div class="container">

        @yield('content')

    </div>

</main>

{{-- FOOTER --}}
<footer class="text-center py-3 mt-4">

    <small>

        © {{ date('Y') }} Gudang Kerinci

    </small>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>

</html>