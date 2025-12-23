<!-- partials/sidebar.blade.php -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('operator/dashboard') ? 'active' : '' }}">
                    <a href="/operator/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Main Menu</h4>
                </li>
                <li class="nav-item {{ Request::is('operator/pendaftar*') ? 'active' : '' }}">
                    <a href="/operator/pendaftar">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Pendaftar</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('operator/transaksi*') ? 'active' : '' }}">
                    <a href="/operator/transaksi">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
