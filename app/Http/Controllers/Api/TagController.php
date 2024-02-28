<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\TagRequest;
use App\Http\Resources\GeneralResource;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * @OA\Get(
     *     path="/api/tags",
     *     summary="Get list of tags",
     *     tags={"Tags"},
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return GeneralResource::collection(Tag::all());
    }


    /**
     * @OA\Post(
     *      path="/api/tags",
     *      tags={"Tags"},
     *      summary="Create new tag",
     *      description="Create new tag",
            @OA\RequestBody(
                required=true,
                description="Create new tag",

     *     @OA\MediaType(
             * mediaType="multipart/form-data",
             * @OA\Schema(
             * type="object",
             * @OA\Property(property="name", type="string", format="string", example="test", description ="tag name"),
             * )

             * ),
            * ),
 *     @OA\Response(
     *           response=204,
     *           description="Successful operation",
     *           @OA\JsonContent()
     *        )
     * )
     */
    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $result = $this->tagService->store($data);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * @OA\Get(
     *     path="/api/tags/{tag}",
     *     summary="Get tag",
     *     tags={"Tags"},
     *       @OA\Parameter(
     *       name="tag",
     *       in="path",
     *       required=true,
     *       description= "tag id",
     *       example="10",
     *       @OA\Schema(
     *            type="integer"
     *       )
     *       ),
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function show(Tag $tag)
    {
        return response(['data' => $tag]);
    }


    /**
     * @OA\Put(
     *      path="/api/tags/{tag}",
     *      tags={"Tags"},
     *      summary="Create new tag",
     *      description="Create new tag",
     *     @OA\Parameter(
     * name="tag",
     * in="path",
     * required=true,
     * description= "tag id",
     * example="1",
     * @OA\Schema(
     * type="integer"
     * )
     * ),
            @OA\RequestBody(
                required=true,
                description="Create new tag",

            @OA\MediaType(
                mediaType="multipart/form-data",
                @OA\Schema(
                type="object",
                @OA\Property(property="name", type="string", format="string", example="test", description ="tag name"),
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

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $result = $this->tagService->update($data, $tag);
        return response(['message' => $result['message']])->setStatusCode($result['code']);
    }


}
