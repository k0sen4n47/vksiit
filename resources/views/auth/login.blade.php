@extends('layouts.app')

@section('title-page')
Авторизация
@endsection

@guest
@section('noHeaderFooter', true)
@endguest

@section('content')
<form action="{{ route('login') }}" method="POST" class="registration-form" autocomplete="off">
    @csrf
    <div class="form-holder">
        <a href="#" class="logo-link">
            <img src="{{ asset('images/logotypes/logo.svg') }}" alt="Logo" class="logo" />
        </a>
        <div class="title">Авторизация</div>
        <div class="form-top">
            <div class="form-floating">

                <input class="form-control" type="text" name="login" id="login" placeholder="Ваш логин" required>
            </div>
            <div class="form-floating">

                <input class="form-control" type="password" name="password" id="password" placeholder="Ваш пароль" required>
            </div>
        </div>
        <button class="btn" type="submit">Вход</button>
</form>
@endsection