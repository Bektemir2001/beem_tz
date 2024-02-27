<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store(array $data): array
    {
        try{
            $category = Product::create($data);
            return ['message' => 'success', 'code' => 200, 'category' => $category];
        }
        catch (\Exception $e)
        {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
