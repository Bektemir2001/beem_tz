<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function store(array $data): array
    {
        try{
            $tag = Tag::create($data);
            return ['message' => 'success', 'code' => 200, 'tag' => $tag];
        }
        catch (\Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update($data, Tag $tag)
    {
        try{
            $tag->update($data);
            return ['message' => 'success', 'code' => 200, 'tag' => $tag];
        }
        catch (\Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }

    }
}
