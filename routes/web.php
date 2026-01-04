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
    return Inertia::render('User/List');
});

Route::get('/topicos/desenvolvimento-web', function () {
    return Inertia::render('Topics/Show');
});

Route::get('/topicos/desenvolvimento-web/13', function () {
    return Inertia::render('Topics/View');
});

Route::get('/topicos/create', function () {
    return Inertia::render('Topics/Create');
});

Route::get('/user/tiago_dev', function () {
    return Inertia::render('User/Show');
});

Route::get('/entrar', function () {
    return Inertia::render('Auth/Authentication');
});