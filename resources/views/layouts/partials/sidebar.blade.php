<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">Dispensasi</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="/pengajuan">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengajuan</span>
        </a>
    </li>

    @can('guru-piket', 'admin')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Data
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="/dispensasi">
                <i class="fas fa-fw fa-cog"></i>
                <span>Dispensasi</span>
            </a>
        </li>
    @endcan

    @can('admin')
    <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Data
        </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Akun</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/users">Daftar Pengguna</a>
                <h6 class="collapse-header">Register :</h6>
                <a class="collapse-item" href="/import-form">Excel</a>
                <a class="collapse-item" href="/register">Manual</a>
            </div>
        </div>
    </li>
    @endcan

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>