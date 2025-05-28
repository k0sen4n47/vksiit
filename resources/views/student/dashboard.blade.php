@extends('layouts.app')

@section('title-page')
Личный кабинет студента
@endsection

@section('content')
<div class="container">
    <h1>Добро пожаловать в личный кабинет студента!</h1>

    @auth
        <p>Вы вошли как: {{ $student->fio ?? 'Студент' }}</p>
        {{-- Здесь будет контент кабинета студента --}}
    @endauth

    @guest
        <p>Пожалуйста, авторизуйтесь, чтобы просмотреть личный кабинет студента.</p>
    @endguest

</div>
@endsection 