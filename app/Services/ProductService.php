<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function store(array $data): array
    {
        try{
            DB::beginTransaction();
            $tags = isset($data['tags']) ? $this->tagsHandle($data['tags']) : [];
            unset($data['tags']);
            $product = Product::create($data);
            if (!empty($tags)) {
                $product->tags()->attach($tags);
            }
            DB::commit();
            return ['message' => 'success', 'code' => 200, 'product' => $product];
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function update(array $data, Product $product): array
    {
        try{
            DB::beginTransaction();
            $tags = isset($data['tags']) ? $this->tagsHandle($data['tags']) : [];
            unset($data['tags']);
            $product->update($data);
            if (!empty($tags)) {
                $product->tags()->sync($tags);
            }
            DB::commit();
            return ['message' => 'success', 'code' => 200, 'category' => $product];
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function isNumericString($str) {
        return ctype_digit($str);
    }

    public function tagsHandle($tags)
    {
        if(is_string($tags))
        {
            $tags = explode(',', $tags);
        }
        for($i = 0; $i < count($tags); $i++)
        {
            if(!$this->isNumericString($tags[$i]))
            {
                $new_tag = Tag::firstOrCreate(['name' => $tags[$i]]);
                $tags[$i] = $new_tag->id;
            }
        }
        return $tags;
    }
}
