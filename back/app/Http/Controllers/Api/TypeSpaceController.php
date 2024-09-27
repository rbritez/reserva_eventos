<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Tag(
 *     name="Types Spaces",
 *     description="API endpoints for managing Types spaces"
 * )
 */
class TypeSpaceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/types",
     *     summary="Get available space types",
     *     tags={"Types Spaces"},
     *     security={{"jwt": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of available space types",
     *         @OA\JsonContent(ref="#/components/schemas/TypeSpaceResource")
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $types = Type::all();
        return response()->json(TypeResource::collection($types), Response::HTTP_OK);
    }
}
