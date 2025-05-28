@extends('layouts.app')

@section('title-page')
Личный кабинет преподавателя
@endsection

@section('content')
<div class="container">
    <h1>Добро пожаловать в личный кабинет преподавателя!</h1>

    @auth
        <p>Вы вошли как: {{ $teacher->fio ?? 'Преподаватель' }}</p>
        {{-- Здесь будет контент кабинета преподавателя --}}
    @endauth

    @guest
        <p>Пожалуйста, авторизуйтесь, чтобы просмотреть личный кабинет преподавателя.</p>
    @endguest

</div>
@endsection 