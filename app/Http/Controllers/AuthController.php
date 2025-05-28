<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Отображает форму входа.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Обрабатывает попытку аутентификации пользователя.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Валидация данных формы
        $credentials = $request->validate([
            'login' => ['required'], // Валидируем поле логина
            'password' => ['required'],
        ]);

        // Попытка аутентификации по логину и паролю
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Получаем аутентифицированного пользователя
            $user = Auth::user();

            // Перенаправление в зависимости от роли
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Перенаправляем админа всегда на панель админа
            } elseif ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard'); // Перенаправляем преподавателя на его панель
            } else { // Предполагаем, что все остальные - студенты
                return redirect()->route('student.dashboard'); // Перенаправляем студента на его панель
            }
        }

        // Если аутентификация не удалась, возвращаемся на форму с ошибкой
        return back()->withErrors([
            'login' => 'Указанные учетные данные не соответствуют нашим записям.',
        ])->onlyInput('login');
    }
}
