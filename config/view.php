<?php

use Illuminate\Support\Facades\Config;

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify an array of paths that should be checked for your
    | views. Of course the usual Laravel view path has already been placed
    | for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. You are free to change this value to any other location.
    |
    */

    'compiled' => env('VIEW_COMPILED', realpath(storage_path('framework/views'))),

];
