<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaceRequest;
use App\Http\Resources\SpaceResource;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Spaces",
 *     description="API endpoints for managing spaces"
 * )
 */
class SpaceController extends Controller
{
    /**
    * 
    * @OA\Get(
    *     path="/api/v1/spaces",
    *     summary="List all spaces",
    *     tags={"Spaces"},
    *     security={{"jwt": {}}},
    *     @OA\Response(
    *         response="200",
    *         description="List of spaces",
    *         @OA\JsonContent(
    *             type="array",
    *             @OA\Items(ref="#/components/schemas/SpaceResource")
    *         )
    *     )
    * )
    * 
    * 
    * listing of the spaces.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(): JsonResponse
    {
        $spaces = Space::with('type')->get();
        return response()->json(SpaceResource::collection($spaces), Response::HTTP_OK);
    }

    /**
     * 
     * @OA\Post(
     *     path="/api/v1/spaces",
     *     summary="Create a new space",
     *     tags={"Spaces"},
     *     security={{"jwt": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreSpaceRequest")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Space created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SpaceResource")
     *     ),
     *     @OA\Response(response="404", description="Space not found"),
     *     @OA\Response(response="422", description="Validation Error")
     * )
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpaceRequest $request): JsonResponse
    {
        $space = Space::create($request->validated());
        return response()->json(new SpaceResource($space), Response::HTTP_CREATED);
    }

    /**
     * 
    * @OA\Get(
    *     path="/api/v1/spaces/{id}",
    *     summary="Display the specified resource",
    *     tags={"Spaces"},
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
    *         @OA\JsonContent(ref="#/components/schemas/SpaceResource")
    *     ),
    *     @OA\Response(response="404", description="Resource not found")
    * )
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space): JsonResponse
    {
        return response()->json(new SpaceResource($space->load('type')), Response::HTTP_OK);
    }

    /**
     * 
     * @OA\Put(
     *     path="/api/v1/spaces/{id}",
     *     summary="Update a space",
     *     tags={"Spaces"},
     *     security={{"jwt": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreSpaceRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Space updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SpaceResource")
     *     ),
     *     @OA\Response(response="404", description="Space not found"),
     *     @OA\Response(response="422", description="Validation Error")
     * )
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpaceRequest $request, Space $space): JsonResponse
    {
        // Actualiza el espacio con los datos validados
        $space->update($request->validated());

        // Devuelve el recurso actualizado
        return response()->json(new SpaceResource($space), Response::HTTP_OK);
    }

    /**
     * 
     * 
     * @OA\Delete(
     *     path="/api/v1/spaces/{id}",
     *     summary="Delete a space",
     *     tags={"Spaces"},
     *     security={{"jwt": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the space to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Space deleted successfully"
     *     ),
     *     @OA\Response(response="404", description="Space not found")
     * )
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Space $space): JsonResponse
    {
        // Eliminar las reservas relacionadas
        if ($space->reservations()->exists()) {
            $space->reservations()->delete();
        }
        $space->delete();
    
        return response()->json([], Response::HTTP_OK);
    }
}
