<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Vehicle",
 *     description="Автомобиль",
 *     @OA\Property(property="id", type="integer", format="int64", description="Идентификатор"),
 *     @OA\Property(property="model_id", type="integer", format="int64", description="Идентификатор модели"),
 *     @OA\Property(property="vin", type="string", description="VIN номер"),
 *     @OA\Property(property="number_plate", type="string", description="Номерной знак"),
 *     @OA\Property(property="status", type="string", description="Статус автомобиля"),
 *     @OA\Property(property="location", type="object", description="Местоположение автомобиля", example={"latitude": 40.7128, "longitude": -74.0060}),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Дата создания"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Дата обновления"),
 * )
 */
class Vehicle extends JsonResource
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
