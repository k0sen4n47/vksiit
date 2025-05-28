@extends('admin.dashboard')

@section('admin_content')
<div class="form-holder"> {{-- Основной контейнер формы --}}
    <div class="title">Редактировать предмет: {{ $subject->name }}</div> {{-- Заголовок формы --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST"> {{-- Действие формы будет на маршрут обновления предмета --}}
        @csrf
        @method('PUT') {{-- Используем метод PUT для обновления --}}

        <div class="form-top"> {{-- Контейнер для верхних элементов формы --}}
            <div class="form-floating"> {{-- Поле Название предмета --}}
                <label class="label-input" for="name">Название предмета:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-floating"> {{-- Поле Аббревиатура предмета --}}
                <label class="label-input" for="abbreviation">Аббревиатура предмета:</label>
                <input type="text" name="abbreviation" id="abbreviation" class="form-control" value="{{ old('abbreviation', $subject->abbreviation) }}" required>
            </div>
            @error('abbreviation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <h3>Назначение преподавателей и групп</h3> {{-- Заголовок секции --}}

            {{-- Секция для отображения текущих связей и возможности их изменения/добавления новых --}}
            @foreach ($subject->teachersAndGroups as $connection)
                <div class="form-top__connection-item"> {{-- Контейнер для одной связи --}}
                    <div class="form-floating"> {{-- Поле Преподаватель для связи --}}
                        <label class="label-input" for="connections[{{ $loop->index }}][teacher_id]">Преподаватель:</label>
                        <select name="connections[{{ $loop->index }}][teacher_id]" id="connections[{{ $loop->index }}][teacher_id]" class="form-control">
                            <option value="">Выберите преподавателя</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('connections.' . $loop->parent->index . '.teacher_id', $connection->id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->fio }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('connections.' . $loop->index . '.teacher_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-floating"> {{-- Поле Группа для связи --}}
                        <label class="label-input" for="connections[{{ $loop->index }}][group_id]">Группа:</label>
                        <select name="connections[{{ $loop->index }}][group_id]" id="connections[{{ $loop->index }}][group_id]" class="form-control">
                            <option value="">Выберите группу</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ old('connections.' . $loop->parent->index . '.group_id', $connection->pivot->group_id) == $group->id ? 'selected' : '' }}>{{ $group->short_name }}-{{ $group->course }}{{ $group->year }}@if(!empty($group->suffix)) {{ $group->suffix }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    @error('connections.' . $loop->index . '.group_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                 {{-- Кнопка для удаления этой связи (нужно доработать с JS) --}}
                {{-- <button type="button" class="btn btn-danger btn-sm remove-connection">Удалить связь</button> --}}
                <hr> {{-- Разделитель между связями --}}
            @endforeach

            {{-- Секция для добавления новой связи (можно сделать с JS) --}}
             {{-- <button type="button" class="btn btn-secondary add-connection">Добавить связь</button> --}}
            <p>Добавление/удаление связей требует доработки с JavaScript.</p> {{-- Пока оставим так --}}

        </div>

        <button type="submit" class="btn btn-primary">Обновить предмет</button> {{-- Кнопка отправки --}}
    </form>
</div>
@endsection