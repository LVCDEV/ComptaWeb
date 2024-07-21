<nav class="navbar navbar-dark bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('app.index') }}">ComptaWeb</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-primary" tabindex="-1" id="offcanvasDarkNavbar"
             aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => str_starts_with($routeName, 'app.')]) href="{{ route('app.index')
                        }}"><i class="bi bi-house"></i> Home</a>
                    </li>
                </ul>
                @auth
                    <hr class="table-group-divider mt-4 mb-4">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a @class(['nav-link', 'dropdown-toggle', 'active' => str_starts_with($routeName, 'app.transactions')]) href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false"><i class="bi bi-bank"></i> Transactions</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('app.transactions.index') }}"><i class="bi
                                bi-file-earmark-binary"></i> Liste</a></li>
                                <li><a class="dropdown-item" href="{{ route('app.transactions.create') }}"><i class="bi
                                bi-file-earmark-binary"></i> Recettes/Dépenses</a></li>
                                <li><a class="dropdown-item" href="{{ route('app.transactions.create_transfert') }}"><i class="bi
                                bi-file-earmark-binary"></i> Virements</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => str_starts_with($routeName, 'app.accounts.')]) href="{{ route('app.accounts.index') }}"><i class="bi bi-cash-coin"></i> Accounts</a>
                        </li>
                    </ul>
                    @if(Auth::user()->user_type_id === $admin)
                        <hr class="table-group-divider mt-4 mb-4">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.banks.')]) href="{{
                                        route('admin.banks.index') }}"><i class="bi bi-bank"></i> Banks</a>
                            </li>
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.users')]) href="{{ route('admin.users.index') }}"><i
                                        class="bi bi-person-fill"></i> Users</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false"><i class="bi bi-gear"></i> Settings</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.accounttypes.index') }}"><i class="bi
                                    bi-file-earmark-binary"></i> Account Types</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                    <hr class="table-group-divider mt-4 mb-4">
                    <div class="navbar-nav">
                        @if(Auth::user()->user_type_id == $admin)
                            <p class="nav-link, active"><i class="bi bi-person-fill-gear"></i> {{ Auth::user()->name }}
                            </p>
                        @else
                            <p class="nav-link, active"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</p>
                        @endif

                        <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="nav-link"><i class="bi bi-door-open-fill"></i> Logout</button>
                        </form>
                    @endauth
                    @guest
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login') }}"><i class="bi bi-box-arrow-in-right"></i>
                                Login</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
