<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Left Side Of Navbar -->
    <a class="navbar-brand" href="{{ route('index') }}">Главная</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="display: flex; justify-content: space-between;">
        <ul class="navbar-nav">

            <li class="nav-item @yield('active_all')">
                <a class="nav-link" href="{{ route('news.all') }}">Новости</a>
            </li>
            <li class="nav-item @yield('active_add')">
                <a class="nav-link" href="{{ route('news.add') }}">Добавить новость</a>
            </li>
            <li class="nav-item @yield('active_admin')">
                <a class="nav-link" href="{{ route('admin') }}">Администрирование</a>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav">
        @guest
            <!-- Гость -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                    </li>
                @endif
            @else
            <!-- Мой аккаунт -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Мой аккаунт
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('home') }}">Мой аккаунт</a>
                        <a class="dropdown-item" href="#">Избранные новости</a>
                        <a class="dropdown-item" href="#">Настройки</a>
                        <a class="dropdown-item" href="#">Выйти</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            @endguest
        </ul>
    </div>
</nav>
