<?php

use Illuminate\Support\Facades\Route;

Route::get('hello', function() {
    return response()->json([
        'status' => 200,
        'data' => "hello world versi 2"
    ]);
})->name('greetingV2');
