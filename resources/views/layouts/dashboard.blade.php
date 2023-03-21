<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Админка</title>
    <meta name="description" content="админка">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Стили -->
   
    <link rel="stylesheet" href="css/style.css">
    

    <!-- Font Awesome иконки -->
    <script src="https://kit.fontawesome.com/4a23243fb41.js" crossorigin="anonymous"></script>

    <!-- jQuery и скрипты -->
    <script src="js/main.js"></script>

</head>
<body>
    <!-- Главный контейнер -->
    <div class="container">

        <!-- Заголовок -->
        <header class="dashboard-header">
            <h1 class="dashboard-header__logo">Админка</h1>
        </header>

        <!-- Левое меню -->
        <nav class="sidebar-menu">
            <ul class="sidebar-menu__items">
                <li class="sidebar-menu__item">
                    <a href="#" class="sidebar-menu__item-title">
                        <span>Общие</span>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <ul class="sidebar-menu__subitems">
                        <li class="sidebar-menu__subitem">
                            <a href="#">
                                <i class="fas fa-user"></i>
                                <span>Пользователи</span>
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
        <table border="5px" align="center">
                     <thead>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Usersgroup id</th>
                        <th>Usersgroup name</th>
                    </thead>
                    <tbody>
                       @foreach($users as $key => $user)
                           @if($user)
                        <tr>
                            <td class="table-text">
                                <p>{{ $user -> name }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> id }}</p>                                
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> email }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> created_at }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $user -> usersgroup_id ? $user -> usersgroup_id : 'No' }}</p>
                            </td>
                            <td class="table-text">
                                <p>{{ $usersGroupNames[$user -> id] }}</p>                                
                            </td>
                        </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
        </main>
    </div>
</body>
</html>