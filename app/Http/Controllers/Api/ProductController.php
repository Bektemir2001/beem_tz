<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProductRequest;
use App\Http\Resources\GeneralResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get list of products",
     *     tags={"Products"},
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return GeneralResource::collection(Product::all());
    }


    /**
     * @OA\Post(
     *      path="/api/products",
     *      tags={"Products"},
     *      summary="Create new product",
     *      description="Create new product",
            @OA\RequestBody(
                required=true,
                description="Create new product",
                @OA\MediaType(
                mediaType="multipart/form-data",
                 * @OA\Schema(
                 * type="object",
                 *      @OA\Property(property="name", type="string", format="string", example="test", description ="product name"),
                 *      @OA\Property(property="description", type="text", format="text", example="test description", description ="product description"),
                 *      @OA\Property(property="category_id", type="integer", format="integer", example="1", description ="category"),
                 *      @OA\Property(property="tags", type="array", @OA\Items(type="integer"), @OA\Schema(type="array"), example="[1,2]", description ="tags"),
                 * )
                )

            ),
     *     @OA\Response(
     *           response=204,
     *           description="Successful operation",
     *           @OA\JsonContent()
     *        )
     * )
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $result = $this->productService->store($data);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{product}",
     *     summary="Get product",
     *     tags={"Products"},
     *       @OA\Parameter(
     *       name="product",
     *       in="path",
     *       required=true,
     *       description= "product id",
     *       example="10",
     *       @OA\Schema(
     *            type="integer"
     *       )
     *       ),
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function show(Product $product)
    {
        return response(['data' => $product]);
    }



    /**
     * @OA\Put(
     *      path="/api/products/{product}",
     *      tags={"Products"},
     *      summary="Create new product",
     *      description="Create new product",
     *     @OA\Parameter(
             * name="product",
             * in="path",
             * required=true,
             * description= "product id",
             * example="1",
             * @OA\Schema(
             * type="integer"
             * ),
              ),
            @OA\RequestBody(
            required=true,
            description="Create new product",
             * @OA\MediaType(
             * mediaType="multipart/form-data",
             * @OA\Schema(
             * type="object",
             *      @OA\Property(property="name", type="string", format="string", example="test", description ="product name"),
             *      @OA\Property(property="description", type="text", format="text", example="test", description ="product description"),
             *      @OA\Property(property="category_id", type="integer", format="integer", example="1", description ="category"),
             *      @OA\Property(property="tags", type="array", @OA\Items(type="integer"), example="[1,2]", description ="tags"),
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
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $result = $this->productService->update($data, $product);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
