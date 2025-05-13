<?php

namespace App\Http\Controllers\Api\V1;

use App\Base\Vehicle\Location;
use App\Base\Renter\Rent\Manager as RentManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vehicle;
use App\Models\Enums\VehicleAvailabilityStatus;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use OpenApi\Annotations as OA;

class RentController extends Controller
{
    /**
     * @param \App\Base\Renter\Rent\Manager $manager
     */
    public function __construct(
        private readonly RentManager $manager
    ) {
        //
    }

    /**
     * @OA\POST(
     *     path="/api/v1/rents/{vehicle_id}",
     *     summary="Аренда ТС",
     *     tags={"Rent"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Аренда ТС",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Rent"))
     *     )
     * )
     */
    public function rent(int $vehicle_id)
    {
        $this->manager->rent(Auth::id(), $vehicle_id);

        return Vehicle::collection($this->manager->getAvailableItems());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/vehicles/{id}",
     *     summary="Получить ТС по ID",
     *     tags={"Vehicle"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ТС найдено",
     *         @OA\JsonContent(ref="#/components/schemas/Vehicle")
     *     )
     * )
     */
    public function item(int $id) : Vehicle
    {
        return Vehicle::make($this->manager->getById($id));
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/vehicles/{id}/status",
     *     summary="Обновить статус ТС",
     *     tags={"Vehicle"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Статус обновлён",
     *         @OA\JsonContent(type="object", @OA\Property(property="updated", type="boolean", example=true))
     *     )
     * )
     */
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => ['required', new Enum(VehicleAvailabilityStatus::class)],
        ]);

        $updated = $this->manager->updateStatus($id, $request->status);

        return response()->json($updated);
    }

    /**
     * @OA\Patch(
     *     path="/api/v1/vehicles/{id}/location",
     *     summary="Обновить координаты ТС",
     *     tags={"Vehicle"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"latitude", "longitude"},
     *             @OA\Property(property="latitude", type="number", format="float", example=40.7128),
     *             @OA\Property(property="longitude", type="number", format="float", example=-74.0060)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Локация обновлена",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *         )
     *     )
     * )
     */
    public function updateLocation(Request $request, int $id)
    {
        $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        $location = Location::from(
            $request->input('latitude'),
            $request->input('longitude'),
        );

        $this->manager->updateLocation($id, $location);

        return response()->json(['message' => 'Данные обновлены.']);
    }
}