@extends('layouts.app')

@section('title-page')
Приветствие
@endsection

@guest
@section('noHeaderFooter', true)
@endguest
@section('content')
<div class="welcome-container">
    <main class="welcome-main">
        <section class="banner">
            <div class="banner__background">
                <div class="banner__shape banner__shape--1"></div>
                <div class="banner__shape banner__shape--2"></div>
                <div class="banner__dots"></div>
                <div class="banner__wave"></div>
            </div>

            <div class="banner__content">
                <h2 class="banner__title">Начните свое обучение сегодня</h2>
                <p class="banner__description">Откройте для себя мир знаний и новых возможностей с нашей платформой дистанционного обучения</p>
                <a href="/login" class="banner__button">Войти</a>
            </div>

            <div class="banner__illustration">
                <div class="banner__illustration-item banner__illustration-item--book">
                    <img src="{{ asset('images/1.png') }} ">
                </div>
                <div class=" banner__illustration-item banner__illustration-item--laptop">
                    <img src="{{ asset('images/2.jpg') }}">
                </div>
                <div class="banner__illustration-item banner__illustration-item--certificate">
                    <img src="{{ asset('images/3.jpg') }}">
                </div>
            </div>
        </section>
    </main>
</div>
@endsection