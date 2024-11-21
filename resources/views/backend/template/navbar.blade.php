<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        @if (Auth::check() && Auth::user()->teacher && Auth::user()->teacher->photo)
                            <img src="{{ asset('storage/' . Auth::user()->teacher->photo) }}" alt="Profile Photo"
                                class="avatar-img rounded-circle" />
                        @else
                            <img src="{{ asset('backend/assets/img/profile.png') }}" alt=""
                                class="avatar-img rounded-circle" />
                        @endif
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                @if (Auth::check() && Auth::user()->teacher && Auth::user()->teacher->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->teacher->photo) }}"
                                        alt="Profile Photo" class="avatar-img rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover;" />
                                @else
                                    <img src="{{ asset('backend/assets/img/profile.png') }}" alt=""
                                        class="avatar-img rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover;" />
                                @endif
                                <div class="u-text">
                                    <h4>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h4>
                                    <p class="text-muted">{{ Auth::check() ? Auth::user()->email : 'No Email' }}</p>
                                    @if (Auth::check() && Auth::user()->teacher)
                                        <a href="{{ route('panel.teacher.show', Auth::user()->teacher->id) }}"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    @else
                                        <a href="#" class="btn btn-xs btn-secondary btn-sm disabled">View
                                            Profile</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            @if (Auth::check() && Auth::user()->teacher)
                                <a class="dropdown-item"
                                    href="{{ route('panel.teacher.show', Auth::user()->teacher->id) }}">Edit Profile</a>
                            @else
                                <a class="dropdown-item disabled">Edit Profile</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
