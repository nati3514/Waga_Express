<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between"> <a href="index.html"
            class="logo d-flex align-items-center"> <img src="{{ asset('backend/assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">{{ __('Waga') }}</span> </a> <i class="bi bi-list toggle-sidebar-btn"></i>
            {{-- <a class="navbar-brand" href="{{ url('/') }}"> waga</a> --}}
        </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <div class="dropdown">
                <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span
                        class="flag-icon flag-icon-{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}"></span>
                    {{ Config::get('languages')[App::getLocale()]['display'] }}
                </a>
                </a>

                {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span
                                    class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></span>
                                {{ $language['display'] }}</a>
                        @endif
                    @endforeach
                </ul> --}}
            </div>


            <li class="nav-item d-block d-lg-none"> <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i> </a></li>
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"> <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span> </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header"> You have 4 new notifications <a href="#"><span
                                class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer"> <a href="#">Show all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"> <i
                        class="bi bi-chat-left-text"></i> <span class="badge bg-success badge-number">3</span> </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header"> You have 3 new messages <a href="#"><span
                                class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="{{ asset('backend/assets/img/messages-1.jpg') }}" alt=""
                                class="rounded-circle">
                            <div>
                                <h4>Jassa</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="{{ asset('backend/assets/img/messages-2.jpg') }}" alt=""
                                class="rounded-circle">
                            <div>
                                <h4>Jassa</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="#">
                            <img src="{{ asset('backend/assets/img/messages-3.jpg') }}" alt=""
                                class="rounded-circle">
                            <div>
                                <h4>Jassa</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer"> <a href="#">Show all messages</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('backend/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->first_name }}</span> </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->first_name }}</h6>
                        {{-- <span>{{ Auth::user()->email }}<br></span>
                        <span>{{ $user_data->branch_name }}<br></span>
                        <span>{{ $user_data->status }}</span> --}}
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li> <a class="dropdown-item d-flex align-items-center" href="{{ route('user.profile') }}"> <i
                        class="bi bi-person"></i> <span>{{ __('My Profile') }}</span> </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    {{-- <li> <a class="dropdown-item d-flex align-items-center" href="users-profile.html"> <i
                                class="bi bi-gear"></i> <span>Account Settings</span> </a></li>
                    <li> --}}
                    <hr class="dropdown-divider">
            </li>
            {{-- <li> <a class="dropdown-item d-flex align-items-center" href="pages-faq.html"> <i
                                class="bi bi-question-circle"></i> <span>Need Help?</span> </a></li>
                    <li> --}}
            <hr class="dropdown-divider">
            </li>
            <li>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="dropdown-item text-danger">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> {{ __('Logout') }}
                    </button>

                </form>
            </li>
        </ul>
        </li>
        </ul>
    </nav>
</header>
