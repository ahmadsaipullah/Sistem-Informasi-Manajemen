<!-- Main Sidebar Container -->
<style>
    .sidebar-blue {
        background-color: #2C3E50; /* Warna biru tua */
    }

    .sidebar-blue .nav-link {
        color: #ECF0F1; /* Warna teks putih */
        border: 2px solid transparent; /* Awalnya tanpa border */
        transition: all 0.3s ease-in-out;
    }

    .sidebar-blue .nav-link:hover {
        border: 2px solid #3498DB; /* Outline biru saat hover */
        background-color: transparent; /* Background tetap sama */
        color: #ffffff;
    }

    .sidebar-blue .brand-link {
        border-bottom: 1px solid #3498DB; /* Garis bawah biru */
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-blue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8; border: 2px solid white;">
        <span class="brand-text font-weight-light text-white">Selamat Sempurna</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth()->user()->image)
                    <img src="{{Storage::url(Auth()->user()->image) }}" alt="gambar"
                        width="120px" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" class="img-fluid">
                @else
                    <img src="{{ asset('assets/img/user_default.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.index', encrypt(auth()->user()->id)) }}"
                    class="d-block text-white">{{ Auth()->user()->name }}</a>
                <span class="text-white text-xs"><i class="fa fa-circle text-success"></i> Online</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard</p>
                    </a>
                </li>
                @if (auth()->user()->level_id == 3)
                    <li class="nav-header">Menu</li>
                @endif
                @if (auth()->user()->level_id == 2)
                    <li class="nav-header">Menu</li>
                @endif
                @if (auth()->user()->level_id == 1)
                    <li class="nav-header text-white">Admin Super</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link @yield('admin')">
                            <i class="nav-icon ion ion-person-add"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order_requests.index') }}" class="nav-link @yield('order_request')">
                            <i class="nav-icon ion ion-person-add"></i>
                            <p>Order Requests</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
