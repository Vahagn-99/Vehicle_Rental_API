<?php

namespace App\Http\Controllers\Api\Auth;

use App\Base\Auth\AuthData;
use App\Base\Auth\Manager as AuthManager;
use App\Base\Auth\RegistrationData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Renter;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @param \App\Base\Auth\Manager $manager
     */
    public function __construct(
        private readonly AuthManager $manager,
    ) {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/auth/registration",
     *     summary="Регистрация пользователя",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation" ,"gender"},
     *             @OA\Property(property="name", type="string", format="name"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password"),
     *             @OA\Property(property="gender", type="string", format="male"),
     *             example= {
     *              "name": "user",
     *              "email": "admin@gmail.com",
     *              "password": "password",
     *              "password_confirmation": "password",
     *              "gender": "male"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешная регистрация",
     *         @OA\JsonContent(
     *              @OA\Property(property="access_token", type="string"),
     *              @OA\Property(property="token_type", type="string"),
     *              @OA\Property(property="expires_in", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=412,
     *         description="Не валидные данные"
     *     )
     * )
     */
    public function registration(Request $request)
    {
        $token = $this->manager->registration(RegistrationData::validateAndCreate($request->only(['name', 'email', 'password', 'password_confirmation', 'gender'])));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Авторизовать пользователя",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             example= {
     *              "email": "admin@gmail.com",
     *              "password": "password"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешная авторизация",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string"),
     *             @OA\Property(property="expires_in", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $token = $this->manager->login(AuthData::validateAndCreate($request->only(['email', 'password'])));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/profile",
     *     summary="Получить информацию о текущем пользователе",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Информация о пользователе",
     *         @OA\JsonContent(ref="#/components/schemas/Renter")
     *     )
     * )
     */
    public function profile()
    {
        return Renter::make($this->manager->getAuthUser());
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Выйти из системы",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный выход",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Вы вышли из системы")
     *         )
     *     )
     * )
     */
    public function logout()
    {
        $this->manager->logout();

        return response()->json(['message' => 'Вы вышли из системы']);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/refresh",
     *     summary="Обновить токен доступа",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Новый токен",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string"),
     *             @OA\Property(property="expires_in", type="integer")
     *         )
     *     )
     * )
     */
    public function refresh()
    {
        $token = $this->manager->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
