<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="OperationsHistory",
 *     description="Ресурс для истории операций",
 *     @OA\Property(property="id", type="integer", format="int64", description="Идентификатор"),
 *     @OA\Property(property="renter_id", type="integer", format="int64", description="Идентификатор орендатора"),
 *     @OA\Property(property="status", type="integer", format="int64", description="Статус операции"),
 *     @OA\Property(property="amount", type="number", format="float", description="Сумма"),
 * )
 */
class OperationsHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return parent::toArray($request);
    }
}
