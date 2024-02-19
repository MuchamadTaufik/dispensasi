<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/">Dispensasi</a>

    <!-- Tombol SidebarToggle hanya muncul di mode mobile -->


    <!-- Bagian profil dipindahkan ke pojok kanan -->
    <div class="ms-auto text-end">
        <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 d-lg-none" id="sidebarToggle" href="#!">
                <i class="fas fa-bars"></i>
            </button>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    <li><a class="dropdown-item" href="/notifikasi">Notifikasi</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
