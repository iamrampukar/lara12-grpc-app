<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Proto\Person;
use App\Proto\People;
use App\Proto\BaseModel;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/v1', function() {
    return "Lavel api version:" . app()->version();
});

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

Route::get('/person', function() {
    $p = new Person();
    $p->setName('Ram Pukar');
    return response($p->serializeToJsonString())
    ->header('content-type','application/json');
});

Route::get('/people', function () {
    $people = new People();
    $people->setPeople([
        (function() {
            $p = new Person();
            $p->setName('Ram Pukar');
            return $p;
        })(),
        (function() {
            $p = new Person();
            $p->setName('Adwika');
            return $p;
        })()
    ]);
    return response($people->serializeToJsonString())
    ->header('content-type','application/json');
});

Route::get('/people-v1', function () {
    $people = new People();
    $people->setPeople([
        (function() {
            $p = new Person();
            $p->setBaseModel((function(){
                $bm = new BaseModel();
                $bm->setId(1);
                return $bm;
            })());
            $p->setName('Ram Pukar v1');
            $p->setAddress('Saptri');
            return $p;
        })(),
        (function() {
            $p = new Person();
            $p->setBaseModel((function(){
                $bm = new BaseModel();
                $bm->setId(2);
                return $bm;
            })());
            $p->setName('Ram Pukar v2');
            $p->setAddress('Malhaniya');
            return $p;
        })(),
    ]);

    
    return response($people->serializeToJsonString())
    ->header('content-type','application/json');
});


Route::get('/parse', function () {
    $p = new Person;
    $p->mergeFromJsonString('{
        "name":"Ram Pukar"
    }');

    return response($p->serializeToJsonString())
    ->header('content-type','application/json');
});