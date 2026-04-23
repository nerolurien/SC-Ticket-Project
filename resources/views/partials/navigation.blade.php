<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="brand-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <span>SECURE TICKET</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>

                {{-- MENU INI HANYA MUNCUL JIKA SUDAH LOGIN --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tickets.*') ? 'active' : '' }}"
                            href="{{ route('tickets.index') }}">
                            Tickets
                        </a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav align-items-center">
                @guest
                    {{-- TAMPILKAN JIKA BELUM LOGIN --}}
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                @endguest

                @auth
                    {{-- TAMPILKAN JIKA SUDAH LOGIN --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle bg-light px-3 py-2 rounded-pill" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                {{-- LOGOUT MENGGUNAKAN FORM POST --}}
                                <a class="dropdown-item text-danger" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>