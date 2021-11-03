<!--  BEGIN NAVBAR  -->
<div class="header-container">
    <header class="header navbar navbar-expand-sm">

        <div class="nav-logo align-self-center">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                {{-- logo of your appli 40x40 --}}
                <span class="navbar-brand-name">NewBank</span>
            </a>
        </div>

        <ul class="navbar-item topbar-navigation">

            <!--  BEGIN TOPBAR  -->
            <div class="topbar-nav header navbar" role="banner">
                <nav id="topbar">
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-text">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"> NewBank </a>
                        </li>
                    </ul>

                    <ul class="list-unstyled menu-categories" id="topAccordion">

                            <li class="menu single-menu {{ Request::is('admin/dashboard') ? 'active':''}}">
                                <a href="{{ route('admin.dashboard') }}" >
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        <span>Dashboard</span>
                                    </div>
                                </a>
                            </li>

                            @if (Auth::guard('admin')->user()->role == 1)
                            <li class="menu single-menu {{ Request::is('admin/account_requests') ? 'active':''}}">
                                <a href="{{route('admin.account_requests')}}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                        <span>Demandes d'ouverture de compte</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu single-menu {{ Request::is('admin/account_managments') ? 'active':''}}">
                                <a href="{{route("admin.account_managements")}}">
                                    <div class="/">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                                        <span>Gestion de comptes</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu single-menu {{ Request::is('admin/pret') ? 'active':''}}">
                                <a href="{{route("pret.index")}}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                                        <span>Gestion Pret</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu single-menu {{ Request::is('admin/carte') ? 'active' : '' }}">
                                <a href="{{route("cartes.index")}}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                        <span>carte</span>
                                    </div>
                                </a>
                            </li>

                            <li class="menu single-menu {{ Request::is('admin/agents') ? 'active' : '' }}">
                                <a href="{{route("agent.index")}}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><span>user agent</span>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li class="menu single-menu {{ Request::is('admin/credit') ? 'active' : '' }}">
                                <a href="{{route("credit.index")}}">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        <span>Credit</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!--  END TOPBAR  -->
        </ul>

        <ul class="navbar-item flex-row nav-dropdowns ml-auto">
            <li class="nav-item dropdown user-profile-dropdown align-self-end order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <img src="{{asset('assets/img/profile-7.jpg')}}" class="img-fluid" alt="admin-profile">
                    </div>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <div class="media-body">
                                <h5>{{ Auth::guard('admin')->user()->username }}</h5>
                                @if (Auth::guard('admin')->user()->role == 1)
                                <p>Administrateur</p>
                                @else
                                <p>Agent depot</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (Auth::guard('admin')->user()->role == 1)
                        <div class="dropdown-item">
                            <a href="" data-toggle="modal" data-target="#loginModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                <span>Ajouter agent</span>
                            </a>
                        </div>                       
                    @endif
                    <div class="dropdown-item">
                        <a href='{{ route("admin.postLogout") }}' onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                        </a>
                    </div>
                    <form id="logout-form" action='{{ url("/admin/logout") }}' method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->
