<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Renter",
 *     description="Арендатор",
 *     @OA\Property(property="id", type="integer", format="int64", description="Идентификатор"),
 *     @OA\Property(property="name", type="string", description="Имя"),
 *     @OA\Property(property="email", type="string", format="email", description="Почта"),
 *     @OA\Property(property="gender", type="string", description="Пол"),
 *     @OA\Property(property="status", type="integer", format="int64", description="Статус"),
 * )
 */
class Renter extends JsonResource
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
