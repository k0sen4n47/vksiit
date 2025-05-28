<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Пользователь не авторизован, перенаправляем на страницу входа
            return redirect('login');
        }

        $user = Auth::user();

        // Проверяем, имеет ли пользователь одну из разрешенных ролей
        if (!in_array($user->role, $roles)) {
            // У пользователя нет нужной роли, возвращаем ошибку 403 Forbidden
            abort(403, 'У вас нет прав для доступа к этой странице.');
        }

        return $next($request);
    }
} 