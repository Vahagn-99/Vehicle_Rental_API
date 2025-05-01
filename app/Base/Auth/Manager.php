<?php

declare(strict_types=1);


namespace App\Base\Auth;

use App\Models\User;
use Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Manager
{
    /**
     * Овторизовать пользователя.
     *
     * @param \App\Base\Auth\AuthData $dto
     * @return string
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function login(AuthData $dto): string
    {
        if (! $token = JWTAuth::attempt($dto->toArray())) {
            throw new UnauthorizedHttpException('Bearer', 'Доступ запрещен. Неверный логин или пароль.');
        }

        return $token;
    }

    /**
     * Получить информацию о текущем пользователе.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getAuthUser(): ?User
    {
        return Auth::user();
    }

    /**
     * Выйти из системы.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Обновить токен доступа.
     *
     * @return string
     */
    public function refresh(): string
    {
        return JWTAuth::refresh();
    }
}
