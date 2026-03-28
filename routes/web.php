<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf-to-word', function () {
    return view('pdf-to-word');
});

Route::get('/word-to-pdf', function () {
    return view('word-to-pdf');
});
