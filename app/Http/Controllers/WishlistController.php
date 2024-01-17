<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;

class WishlistController extends Controller
{
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
    public function store(StoreWishlistRequest $request)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        return __FUNCTION__ . ' method on ' .__METHOD__;
    }
}
