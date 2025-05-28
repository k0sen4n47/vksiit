@extends('admin.dashboard')

@section('admin_content')
<div class="dashboard__create-content">
    <h2>Создать новый предмет</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="form-create">
            <div class="form-create__top">
                <div class="form-group">
                    <label for="name">Название предмета:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="abbreviation">Аббревиатура предмета:</label>
                    <input type="text" name="abbreviation" id="abbreviation" class="form-control" value="{{ old('abbreviation') }}" required>
                    @error('abbreviation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <h3>Назначение преподавателей и групп</h3>

                <div class="form-group">
                    <label for="connections[0][teacher_id]">Преподаватель:</label>
                    <select name="connections[0][teacher_id]" id="connections[0][teacher_id]" class="form-control">
                        <option value="">Выберите преподавателя</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('connections.0.teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->fio }}</option>
                        @endforeach
                    </select>
                    @error('connections.0.teacher_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="connections[0][group_id]">Группа:</label>
                    <select name="connections[0][group_id]" id="connections[0][group_id]" class="form-control">
                        <option value="">Выберите группу</option>
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ old('connections.0.group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->short_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('connections.0.group_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Создать предмет</button>
        </div>
    </form>
</div>
@endsection