<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <meta name="description" content="админка">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Стили -->
   
    <link rel="stylesheet" href="/css/style.css">
    

    <!-- Font Awesome иконки -->
    <script src="https://kit.fontawesome.com/4a23243fb41.js" crossorigin="anonymous"></script>

    <!-- jQuery и скрипты -->
    <script src="/js/main.js"></script>

</head>
<body>
    <!-- Главный контейнер -->
    <div class="container">

        <!-- Заголовок -->
        <header class="dashboard-header">
            <h1 class="dashboard-header__logo">Admin panel</h1>
        </header>

        <!-- Левое меню -->
        <nav class="sidebar-menu">
            <ul class="sidebar-menu__items">
                <li class="sidebar-menu__item">
                    <a href="/" class="sidebar-menu__item-title">
                        <span>Common</span>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <ul class="sidebar-menu__subitems">
                        <li class="sidebar-menu__subitem">
                            <a href="/dashboard">
                                <i class="fas fa-user"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Главный контент -->
        <main class="main-content">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome, {{ Auth::user()->name }}.
                    </a>
                    <p>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><strong>
                                        {{ __('Logout') }}
                                        </strong></a>
                    </p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                    </form>
                    @yield('content')
                    <a href="{{ route('users') }}">To the dashboards</a>
        </main>
    </div>
</body>
</html>