<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store(array $data): array
    {
        try{
            $category = Category::create($data);
            return ['message' => 'success', 'code' => 200, 'category' => $category];
        }
        catch (\Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
