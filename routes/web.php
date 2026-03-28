<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf-to-word', function () {
    return view('pdfword');
});

Route::get('/word-to-pdf', function () {
    return view('wordtopdf');
});