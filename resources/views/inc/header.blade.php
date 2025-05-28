<header>
    <div class="container">
        <div class="header-info">
            <div class="header-info__left">
                {{-- Ссылка на логотип --}}
                <a href="/" class="logo-link">
                    <img src="{{ asset('images/logotypes/mini-logo.png') }}" alt="" class="logo">
                </a>
                {{-- Навигация для всех пользователей (например, Главная) --}}
                <nav>
                    <a href="{{ route('welcome') }}">Главная</a>
                </nav>
            </div>
            <div class="header-info__right">
                @guest
                {{-- Ссылки для неавторизованных пользователей (только Войти) --}}
                <a href="{{ route('login') }}">Войти</a>
                @endguest

                @auth
                {{-- Ссылки для авторизованных пользователей (Личный кабинет и Выйти) --}}
                <div class="accaunt-wrapper">
                    {{-- Определяем маршрут личного кабинета в зависимости от роли --}}
                    @php
                        $cabinetRoute = '#'; // Маршрут по умолчанию
                        if (Auth::check()) {
                            switch (Auth::user()->role) {
                                case 'admin':
                                    $cabinetRoute = route('admin.dashboard');
                                    break;
                                case 'teacher':
                                    $cabinetRoute = route('teacher.dashboard'); // Маршрут для преподавателя
                                    break;
                                case 'student':
                                    $cabinetRoute = route('student.dashboard'); // Маршрут для студента
                                    break;
                                default:
                                    // Другие роли или маршрут по умолчанию
                                    $cabinetRoute = route('cabinet'); // Возвращаемся к общему маршруту, если роль не определена специфично
                                    break;
                            }
                        }
                    @endphp
                    <a href="{{ $cabinetRoute }}" class="accaunt-wrapper__cabinet nav-link">Личный кабинет</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link">Выйти</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </div>
</header>