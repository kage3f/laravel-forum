<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/topicos', function () {
    return Inertia::render('Topicos');
});