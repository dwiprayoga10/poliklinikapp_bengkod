<aside class="main-sidebar stylish-sidebar-light elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link-light d-flex align-items-center justify-content-center py-3">
        <i class="fas fa-clinic-medical text-primary mr-2 fa-lg animate-pulse"></i>
        <span class="brand-text font-weight-bold text-primary">Poliklinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom">
            <div class="image">
                <img src="https://www.gravatar.com/avatar/2c7d9f6f281ecd3bd65ab915bca6dd57?s=100"
                    class="img-circle elevation-2 user-avatar" alt="User Image">
            </div>
<div class="info ml-2 user-info">
    <span class="welcome-text">Selamat Datang,</span>
    <a href="#" class="d-block user-name">{{ Auth::user()->nama }}</a>
</div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" id="sidebarMenu">
                <!-- ROLE ADMIN -->
                @if (request()->is('admin*'))
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter.index') }}" 
                           class="nav-link {{ request()->routeIs('dokter.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md text-primary"></i>
                            <p>Manajemen Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('polis.index') }}" 
                           class="nav-link {{ request()->routeIs('polis.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hospital text-primary"></i>
                            <p>Manajemen Poli</p>
                        </a>
                    </li>
                @endif

                <!-- ROLE PASIEN -->
                @if (request()->is('pasien*'))
                    <li class="nav-item">
                        <a href="{{ route('pasien.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-columns text-primary"></i>
                            <p>Dashboard Pasien</p>
                        </a>
                    </li>
                @endif

                <!-- ROLE DOKTER -->
                @if (request()->is('dokter*'))
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope text-primary"></i>
                            <p>Dashboard Dokter</p>
                        </a>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="nav-link btn btn-danger text-left w-100 logout-btn">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Keluar</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
/* 🌤️ Sidebar Light Modern Style */
.stylish-sidebar-light {
    background: linear-gradient(180deg, #f8fafc, #f0f7ff);
    color: #1e293b;
    border-right: 1px solid rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
}

.brand-link-light {
    background: linear-gradient(90deg, #ffffff, #e8f4ff);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.animate-pulse {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 0.6; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.1); }
}

/* User avatar */
.user-avatar {
    width: 45px;
    height: 45px;
    border: 2px solid #60a5fa;
    transition: 0.3s ease;
}
.user-avatar:hover {
    transform: rotate(8deg) scale(1.05);
}

/* Navigation Links */
.nav-link {
    color: #334155 !important;
    margin: 4px 8px;
    border-radius: 10px;
    transition: all 0.3s ease;
    background-color: transparent;
}
.nav-link:hover {
    background: rgba(96, 165, 250, 0.15);
    transform: translateX(6px);
}
.nav-link.active {
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    color: #fff !important;
    box-shadow: 0 3px 8px rgba(59, 130, 246, 0.3);
}

/* Logout Button */
.logout-btn {
    border-radius: 10px;
    transition: 0.3s ease;
}
.logout-btn:hover {
    background-color: #ef4444 !important;
    transform: scale(1.03);
}

/* Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.1);
    border-radius: 3px;
}

/* Small animation shadow */
.stylish-sidebar-light:hover {
    box-shadow: 2px 0 15px rgba(0,0,0,0.08);
}
</style>

<script>
// ✨ Interaktif hover kecil
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('mouseenter', () => link.classList.add('hovered'));
    link.addEventListener('mouseleave', () => link.classList.remove('hovered'));
});
</script>
