<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin – Gudang Kerinci')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --hijau: #1b4332; --hijau2: #2d6a2d; --sidebar-w: 240px; }
        body { background: #f4f6f9; display: flex; min-height: 100vh; }
        .sidebar {
            width: var(--sidebar-w); min-height: 100vh;
            background: var(--hijau); position: fixed; top:0; left:0;
            z-index: 100; display: flex; flex-direction: column;
        }
        .sidebar-brand { padding: 20px 16px; color:#fff; font-weight:700; font-size:1.1rem; border-bottom:1px solid rgba(255,255,255,.1); }
        .sidebar-brand span { color: #4caf50; }
        .sidebar .nav-link { color: rgba(255,255,255,.75); padding: 10px 16px; font-size:.9rem; border-radius:6px; margin:2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color:#fff; background:rgba(255,255,255,.15); }
        .sidebar .nav-link i { width: 20px; }
        .sidebar-section { color: rgba(255,255,255,.4); font-size:.7rem; text-transform:uppercase; letter-spacing:.08em; padding:12px 16px 4px; }
        .main-content { margin-left: var(--sidebar-w); flex:1; display:flex; flex-direction:column; }
        .topbar { background:#fff; border-bottom:1px solid #e0e0e0; padding:12px 24px; display:flex; align-items:center; justify-content:space-between; }
        .content-area { padding: 24px; flex:1; }
        .card { border:none; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06); }
        .badge-menunggu { background:#ffc107; color:#000; }
    </style>
    @yield('styles')
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-brand"><i class="bi bi-tree-fill me-2"></i>Gudang <span>Kerinci</span><br>
        <small class="text-white-50 fw-normal" style="font-size:.75rem">Admin Panel</small>
    </div>
    <nav class="pt-2 flex-grow-1">
        <div class="sidebar-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-section">Produk</div>
        <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Kelola Produk
        </a>
        <a href="{{ route('admin.produk.create') }}" class="nav-link">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>

        <div class="sidebar-section">Transaksi</div>
        <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Semua Pesanan
        </a>
        <a href="{{ route('admin.nego.index') }}" class="nav-link {{ request()->routeIs('admin.nego.*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i> Negosiasi
        </a>

        <div class="sidebar-section mt-auto">Akun</div>
        <a href="{{ route('home') }}" class="nav-link"><i class="bi bi-globe"></i> Lihat Website</a>
        <form action="{{ route('logout') }}" method="POST" class="mx-2 mt-1">
            @csrf
            <button class="nav-link btn btn-link w-100 text-start" style="color:rgba(255,255,255,.75)">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>
</div>

{{-- MAIN --}}
<div class="main-content">
    <div class="topbar">
        <h6 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h6>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle text-muted"></i>
            <span class="small text-muted">{{ auth()->user()->name }}</span>
        </div>
    </div>
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>