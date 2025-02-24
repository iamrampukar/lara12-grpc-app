<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/welcome', function() {
    $resp_data = array(
        array('id' => 101,'full_name' => 'Full Name v1'),
        array('id' => 102,'full_name' => 'Full Name v2'),
    );
    return response()->json([
        'message' => 'Data retrieved successfully', 'success' => true,
        'data' => $resp_data 
    ]);
});