<?php

// Send all requests to vue except for /manage
Route::get('{segments}', function () {
    return view('index');
})->where('segments', '^((?!manage).)*$');