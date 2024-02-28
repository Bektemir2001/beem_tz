<?php

namespace App\Http\Controllers\User;

use App\Events\NewRecordCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\TagRequest;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('user.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $result = $this->tagService->store($data);
        if($result['code'] == 200)
        {
            broadcast(new NewRecordCreated($result['tag'], 'tag'))->toOthers();
        }
        return redirect()->route('tags.index')->with(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('user.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('user.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $result = $this->tagService->update($data, $tag);
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
