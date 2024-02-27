<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function store(array $data): array
    {
        try{
            $category = Tag::create($data);
            return ['message' => 'success', 'code' => 200, 'category' => $category];
        }
        catch (\Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
