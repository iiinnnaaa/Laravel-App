<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        /**
         * TODO filter(search by name, price min, price max, pagination. description (partial)-> mysql fulltext index, category name)
         */
//        return ProductResource::collection(Product::all());

        // Search by name
//        return Product::query()->where('name', $request->name)->get();

        // Search by min price
//        return Product::query()->where('price', '>=', $request->price)->get();

        // Search by max price
//        return Product::query()->where('price', '<=', $request->price)->get();

//        return Product::filter($request)->get();
        return ProductResource::collection(Product::with('category')->filter($request)->orderBy('id', 'asc')->paginate(5)->withQueryString());
//        return ProductResource::collection(Product::filter($request)->get());
//        return ProductResource::collection(Product::query()->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        return Product::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, 204);
    }
}
