<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of promo.
     */
    public function promo()
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;  
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }
}
