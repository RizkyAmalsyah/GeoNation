<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('geomap');
});

Route::get('/geomap', function () {
  return view('geomap');
});

Route::get('/datatable', function () {
  return view('datatable');
});
