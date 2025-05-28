<footer>
    <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="{{ route('welcome') }}" class="nav-link px-2 text-body-secondary">Главная</a></li>
        @guest
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link px-2 text-body-secondary">Войти</a></li>
        @endguest
         @auth
            {{-- Ссылку на личный кабинет добавим позже, когда определим маршруты для ролей --}}
            {{-- <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Личный кабинет</a></li> --}}
        @endauth
    </ul> -->
    <p class="text-center text-body-secondary">© {{ date('Y') }} Система дистанционного обучения. Все права защищены.</p>
</footer>