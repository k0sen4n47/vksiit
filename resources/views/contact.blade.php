@extends('layouts.app')

@section('title-page')
Контакты
@endsection
@section('content')
<h1 class="page-title">Контакты</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum perferendis alias repudiandae ratione quisquam accusamus quasi officiis consequuntur doloribus eligendi cupiditate libero quis quibusdam totam quidem dolorum, aliquam possimus illo.</p>

<form action="{{ route('contact-form') }}" method="post">
    @csrf
    <div class="form-group mb-2">
        <label for="name">Введите имя</label>
        <input type="text" name="name" placeholder="Введте имя" id="name" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label for="email">Введите email</label>
        <input type="email" name="email" placeholder="Введте emai" id="email" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label for="name">Тема сообщения</label>
        <input type="text" name="subject" placeholder="Тема сообщения" id="subject" class="form-control">
    </div>
    <div class="form-group mb-2">
        <label for="message">Сообщение</label>
        <textarea name="message" placeholder="Сообщение" id="message" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Отправить</button>
</form>

@endsection