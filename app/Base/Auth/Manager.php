<?php

declare(strict_types=1);


namespace App\Base\Auth;

use App\Base\Renter\Events\UserRegistred;
use App\Models\User as UserModel;
use App\Base\Renter\Repositories\Renter as RenterRepository;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Manager
{
    /**
     * @param \App\Base\Renter\Repositories\Renter $renter_repository
     */
    public function __construct(
        private readonly RenterRepository $renter_repository,
    ) {
        //
    }

    /**
     * Регистрация пользователя.
     *
     * @param \App\Base\Auth\RegistrationData $dto
     * @return string
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function registration(RegistrationData $dto): string
    {
        if ($this->renter_repository->existsByEmail($dto->email)) {
            throw new AuthenticationException("Почта не доступа для регистрации, попробуйте другой.");
        }

        $user = new UserModel();

        $user->name = $dto->name;
        $user->email = $dto->email;
        $user->gender = $dto->gender;
        $user->password = Hash::make($dto->password);

        $user->save();

        UserRegistred::dispatch($user);

        return JWTAuth::fromUser($user);
    }

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
    public function getAuthUser(): ?UserModel
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
