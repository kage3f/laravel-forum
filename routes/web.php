<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/topicos', function () {
    return Inertia::render('Topics/List');
});

Route::get('/membros', function () {
    return Inertia::render('Members');
});

Route::get('/topicos/desenvolvimento-web', function () {
    return Inertia::render('Topics/Show');
});