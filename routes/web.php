<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GroupNameComponentController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/regiser', [RegisterController::class, 'create'])->name('register');
Route::post('/regiser', [RegisterController::class, 'store'])->name('register');

// Маршруты для админ-панели
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Главная страница админки
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Маршруты для групп
    Route::get('/groups/create', [GroupController::class, 'createGroup'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'storeGroup'])->name('groups.store');
    Route::get('/groups', [GroupController::class, 'indexGroups'])->name('groups.index');
    Route::get('/groups/{group}/edit', [GroupController::class, 'editGroup'])->name('groups.edit');
    Route::put('/groups/{group}', [GroupController::class, 'updateGroup'])->name('groups.update');
    Route::delete('/groups/{group}', [GroupController::class, 'destroyGroup'])->name('groups.destroy');

    // Маршруты для студентов
    Route::get('/students/create', [StudentController::class, 'createStudent'])->name('students.create');
    Route::post('/students', [StudentController::class, 'storeStudent'])->name('students.store');
    Route::get('/students', [StudentController::class, 'indexStudents'])->name('students.index');
    Route::get('/students/{student}/edit', [StudentController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroyStudent'])->name('students.destroy');

    // Маршруты для преподавателей
    Route::get('/teachers/create', [TeacherController::class, 'createTeacher'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'storeTeacher'])->name('teachers.store');
    Route::get('/teachers', [TeacherController::class, 'indexTeachers'])->name('teachers.index');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'editTeacher'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'updateTeacher'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroyTeacher'])->name('teachers.destroy');

    // Маршруты для предметов
    Route::get('/subjects/create', [SubjectController::class, 'createSubject'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'storeSubject'])->name('subjects.store');
    Route::get('/subjects', [SubjectController::class, 'indexSubjects'])->name('subjects.index');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'editSubject'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'updateSubject'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroySubject'])->name('subjects.destroy');

    // Маршруты для управления компонентами названий групп
    Route::resource('group-name-components', GroupNameComponentController::class);

});

// Маршруты для личного кабинета студента
Route::prefix('student')->name('student.')->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class.':student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    // Дополнительные маршруты для студента здесь
});

// Маршруты для личного кабинета преподавателя
Route::prefix('teacher')->name('teacher.')->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class.':teacher'])->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    // Дополнительные маршруты для преподавателя здесь
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
