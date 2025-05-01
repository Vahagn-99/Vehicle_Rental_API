<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Balance",
 *     description="Ресурс для баланса",
 *     @OA\Property(property="id", type="integer", format="int64", description="Идентификатор"),
 *     @OA\Property(property="renter_id", type="integer", format="int64", description="Идентификатор орендатора"),
 *     @OA\Property(property="amount", type="number", format="float", description="Сумма"),
 *     @OA\Property(property="currency", type="string", description="Валюта"),
 *     @OA\Property(property="status", type="1"),
 * )
 */
class Balance extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
