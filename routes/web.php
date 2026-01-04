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

Route::get('/topicos/criar', function () {
    return Inertia::render('Topics/Create');
});

Route::get('/topicos/categoria/{slug}', function ($slug) {
    return Inertia::render('Topics/Show', [
        'slug' => $slug
    ]);
});

Route::get('/topicos/{uuid}', function ($uuid) {
    return Inertia::render('Topics/View', [
        'uuid' => $uuid
    ]);
});

Route::get('/user/{username}', function ($username) {
    return Inertia::render('User/Show', [
        'username' => $username
    ]);
});

Route::get('/entrar', function () {
    return Inertia::render('Auth/Authentication');
});
