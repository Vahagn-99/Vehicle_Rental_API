<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="RentalHistory",
 *     description="Ресурс для истории аренды",
 *     @OA\Property(property="id", type="integer", format="int64", description="Идентификатор"),
 *     @OA\Property(property="renter_id", type="integer", format="int64", description="Идентификатор орендатора"),
 *     @OA\Property(property="vehicle_id", type="integer", format="int64", description="Идентификатор автомобиля"),
 *     @OA\Property(property="status", type="integer", format="int64", description="Статус операции"),
 *     @OA\Property(property="started_at", type="string", format="date-time", description="Дата начала"),
 *     @OA\Property(property="ended_at", type="string", format="date-time", description="Дата окончания"),
 * )
 */
class RentalHistory extends JsonResource
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
