<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifikasi
                </h6>
                <div id="notificationContainer" style="max-height: 200px; overflow-y: auto;">
                    @foreach(\App\Models\User::all() as $user)
                        @foreach($user->notifications->where('type', 'App\Notifications\DispensasiApprove') as $notification)
                            <a class="dropdown-item d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notification->data['date'] }}</div>
                                    <span class="font-weight-bold"><strong>{{ $notification->data['title'] }} {{ $notification->data['alasan'] }}</strong><br>
                                        {{ $notification->data['name'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="/notifikasi">Lihat Semua Notifikasi</a>
            </div>
        </li> --}}
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifikasi
                </h6>
                <div id="notificationContainer" style="max-height: 200px; overflow-y: auto;">
                    @php
                        $notifications = collect([]);
                        foreach(\App\Models\User::all() as $user) {
                            $notifications = $notifications->merge($user->notifications->where('type', 'App\Notifications\DispensasiApprove'));
                        }
                        
                        // Terapkan pengurutan
                        $notifications = $notifications->sortByDesc('created_at');
                    @endphp
        
                    @foreach($notifications as $notification)
                        <a class="dropdown-item d-flex align-items-center">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $notification->data['date'] }}</div>
                                <span class="font-weight-bold"><strong>{{ $notification->data['title'] }} ({{ $notification->data['alasan'] }})</strong><br>
                                    {{ $notification->data['name'] }} - {{ $notification->data['kelas'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="/notifikasi">Lihat Semua Notifikasi</a>
            </div>
        </li>        

        <!-- Nav Item - Messages -->
        {{-- <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
                Pesan
            </h6>
            <div style="max-height: 250px; overflow-y: auto;">
                @foreach(auth()->user()->notifications->whereIn('type', ['App\Notifications\DispensasiApprove', 'App\Notifications\DispensasiReject']) as $notification)
                    @php
                        $isApprove = $notification->type == 'App\Notifications\DispensasiApprove';
                        $class = $isApprove ? 'bg-success' : 'bg-danger';
                    @endphp

                    <a class="dropdown-item d-flex align-items-center {{ $class }}">
                        <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="/img/logo_man2.png" alt="...">
                        <div class="status-indicator {{ $isApprove ? 'bg-success' : 'bg-danger' }}"></div>
                        </div>
                        <div>
                        <div class="small text-gray-500">{{ $notification->data['date'] }}</div>
                        <div class="font-weight-bold">{{ $notification->data['title'] }}</div>
                        <div class="text-truncate">{{ $notification->data['messages'] }}</div>
                        </div>
                    </a>
                @endforeach
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="/pesan">Lihat Semua Pesan</a>
            </div>
        </li>  --}}
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Pesan
                </h6>
                <div style="max-height: 250px; overflow-y: auto;">
                    @php
                        $notifications = auth()->user()->notifications
                            ->whereIn('type', ['App\Notifications\DispensasiApprove', 'App\Notifications\DispensasiReject'])
                            ->sortByDesc('created_at');
                    @endphp
        
                    @foreach($notifications as $notification)
                        @php
                            $isApprove = $notification->type == 'App\Notifications\DispensasiApprove';
                            $class = $isApprove ? 'bg-success' : 'bg-danger';
                        @endphp
        
                        <a class="dropdown-item d-flex align-items-center {{ $class }}">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="/img/logo_man2.png" alt="...">
                                <div class="status-indicator {{ $isApprove ? 'bg-success' : 'bg-danger' }}"></div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{ $notification->data['date'] }}</div>
                                <div class="font-weight-bold">{{ $notification->data['title'] }}</div>
                                <div class="text-truncate">{{ $notification->data['messages'] }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="/pesan">Lihat Semua Pesan</a>
            </div>
        </li>
        

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                <img class="img-profile rounded-circle"
                    src="/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"> Logout</button>
                </form>
            </div>
        </li>

    </ul>

</nav>