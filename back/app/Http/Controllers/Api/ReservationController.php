<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusReservationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CreateRequest;
use App\Http\Requests\Reservation\UpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Reservation",
 *     description="API endpoints for managing reservation"
 * )
 */
class ReservationController extends Controller
{
    /**
    * 
    * @OA\Get(
    *     path="/api/v1/reservations",
    *     summary="List all reservations",
    *     tags={"Reservation"},
    *     security={{"jwt": {}}},
    *     @OA\Response(
    *         response="200",
    *         description="List of reservations",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(ref="#/components/schemas/ReservationResource")
    *         )
    *     )
    * )
    * 
    * 
    * listing of the reservation.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): JsonResponse
    {
        $reservations = Reservation::forRole();
        return response()->json(ReservationResource::collection($reservations), Response::HTTP_OK);
    }

    /**
     * 
     * @OA\Post(
     *     path="/api/v1/reservations",
     *     summary="Create a new reservation",
     *     tags={"Reservation"},
     *     security={{"jwt": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ReservationCreateRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Reservation created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ReservationResource")
     *     ),
     *     @OA\Response(response="404", description="Reservation not found"),
     *     @OA\Response(response="422", description="Validation Error")
     * )
     * Store a newly created reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $reservationData = $request->validated();
        $reservationData['status'] = StatusReservationEnum::PENDING->value; 
        $reservation = Reservation::create($reservationData);
        return response()->json(new ReservationResource($reservation), 201);
    }

    /**
     * 
    * @OA\Get(
    *     path="/api/v1/reservations/{id}",
    *     summary="Display the specified reservation",
    *     tags={"Reservation"},
    *     security={{"jwt": {}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Successful response",
    *         @OA\JsonContent(ref="#/components/schemas/ReservationResource")
    *     ),
    *     @OA\Response(response="404", description="Reservation not found")
    * )
     * 
     * Display the specified reservation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation): JsonResponse
    {
        return response()->json(new ReservationResource($reservation->load('user','space')), Response::HTTP_OK);
    }


    /**
     * 
     * @OA\Put(
     *     path="/api/v1/reservations/{id}",
     *     summary="Update a reservation",
     *     tags={"Reservation"},
     *     security={{"jwt": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ReservationUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Reservation updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ReservationResource")
     *     ),
     *     @OA\Response(response="404", description="Reservation not found"),
     *     @OA\Response(response="422", description="Validation Error")
     * )
     * 
     * Update the specified reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Reservation $reservation): JsonResponse
    {
        $reservation->update($request->validated());
        return response()->json(new ReservationResource($reservation), Response::HTTP_OK);
    }

    /**
     * 
     * 
     * @OA\Delete(
     *     path="/api/v1/reservations/{id}",
     *     summary="Delete a reservation",
     *     tags={"Reservation"},
     *     security={{"jwt": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the reservation to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Reservation deleted successfully"
     *     ),
     *     @OA\Response(response="404", description="Reservation not found")
     * )
     * Remove the specified Reservation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        $reservation->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * 
     * @OA\Get(
     *     path="/api/v1/reservations/status",
     *     summary="List all reservations status",
     *     tags={"Reservation"},
     *     security={{"jwt": {}}},
     *     @OA\Response(
     *         response="200",
     *         description="List of reservations status",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *                 enum={"pendiente", "confirmado", "cancelado", "completado", "no utilizado"},
     *                 description="Possible status of a reservation"
     *             )
     *         )
     *     )
     * )
     * 
     * 
     * listing of the reservation.
     *
     * @return \Illuminate\Http\Response
    */

    public function listStatus(): JsonResponse
    {
        $status = StatusReservationEnum::statusArray();
        return response()->json($status, Response::HTTP_OK);
    }
}
