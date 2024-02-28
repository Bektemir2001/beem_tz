<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CategoryRequest;
use App\Http\Resources\GeneralResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Get list of categories",
     *     tags={"Categories"},
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return GeneralResource::collection(Category::all());
    }


    /**
     * @OA\Post(
     *      path="/api/categories",
     *      tags={"Categories"},
     *      summary="Create new category",
     *      description="Create new category",
    @OA\RequestBody(
        required=true,
        description="Create new category",
        @OA\MediaType(
            mediaType="multipart/form-data",
            @OA\Schema(
            type="object",
            @OA\Property(property="name", type="string", format="string", example="test", description ="category name"),
            )
        ),

    ),
     *     @OA\Response(
     *           response=204,
     *           description="Successful operation",
     *           @OA\JsonContent()
     *        )
     * )
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $result = $this->categoryService->store($data);

        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{category}",
     *     summary="Get category",
     *     tags={"Categories"},
     *       @OA\Parameter(
     *       name="category",
     *       in="path",
     *       required=true,
     *       description= "category id",
     *       example="10",
     *       @OA\Schema(
     *            type="integer"
     *       )
     *       ),
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function show(Category $category)
    {
        return response(['data' => $category]);
    }


    /**
     * @OA\Put(
     *      path="/api/categories/{category}",
     *      tags={"Categories"},
     *      summary="Create new category",
     *      description="Create new category",
     *     @OA\Parameter(
             * name="category",
             * in="path",
             * required=true,
             * description= "category id",
             * example="1",
             * @OA\Schema(
             * type="integer"
             * ),
         * ),
            @OA\RequestBody(
                required=true,
                description="Create new category",
             * @OA\MediaType(
             * mediaType="multipart/form-data",
             * @OA\Schema(
             * type="object",
             * @OA\Property(property="name", type="string", format="string", example="test", description ="category name")
             * )
             * )
 *     ),
     *     @OA\Response(
     *           response=204,
     *           description="Successful operation",
     *           @OA\JsonContent()
     *        )
     * )
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $result = $this->categoryService->update($data, $category);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

}
