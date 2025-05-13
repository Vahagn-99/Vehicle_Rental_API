<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Renter\Exceptions\BalanceException;
use App\Base\Renter\Manager as RenterManager;
use App\Base\Renter\UpdateBalance;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBalanceRequest;
use OpenApi\Annotations as OA;
use App\Http\Resources\{
    OperationsHistory as OperationsHistoryResource,
    RentalHistory as RentalHistoryResource,
    Balance as BalanceResource
};
use Auth;

class RenterController extends Controller
{
    /**
     * @param \App\Base\Renter\Manager $manager
     */
    public function __construct(
        protected readonly RenterManager $manager
    ) {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/v1/renters/balance",
     *     summary="Получить баланс арендатора",
     *     tags={"Renter"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Баланс арендатора",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Balance"))
     *     )
     * )
     */
    public function balance()
    {
        return BalanceResource::make($this->manager->getBalance(Auth::id()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/renters/history",
     *     summary="Получить историю аренд арендатора",
     *     tags={"Renter"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Список аренд",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/RentalHistory"))
     *     )
     * )
     */
    public function rentalHistory()
    {
        return RentalHistoryResource::collection($this->manager->getRentalHistory(Auth::id()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/renters/operations",
     *     summary="Получить историю операций арендатора",
     *     tags={"Renter"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Список операций",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/OperationsHistory"))
     *     )
     * )
     */
    public function operationsHistory()
    {
        return OperationsHistoryResource::collection($this->manager->getOperationsHistory(Auth::id()));
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/renters/balance",
     *     summary="Обновить баланс арендатора",
     *     tags={"Renter"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="number", format="float", example=100.00),
     *             required={"status"},
     *              @OA\Property(property="operation_type", type="number", format="integer", example=1, description="Тип операции, где 1 это попалние, 2 списание", enum={1, 2}),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Баланс обновлен",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Баланс успешно обновлен")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка обновления",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Недостаточно средств")
     *         )
     *     )
     * )
     */
    public function updateBalance(UpdateBalanceRequest $request)
    {
        $data = UpdateBalance::from($request->validated());

        try {
            $this->manager->updateBalance(Auth::id(), $data);

            return response()->json(['message' => __('messages.renter.balance_updating_process')]);
        } catch (BalanceException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}