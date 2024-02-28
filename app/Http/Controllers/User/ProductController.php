<?php

namespace App\Http\Controllers\User;

use App\Events\NewRecordCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProductRequest;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('user.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('user.product.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $result = $this->productService->store($data);
        if($result['code'] == 200)
        {
            broadcast(new NewRecordCreated($result['product'], 'product'))->toOthers();
        }
        return redirect()->route('products.index')->with(['message' => $result['message']])->setStatusCode($result['code']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('user.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('user.product.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $result = $this->productService->update($data, $product);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
