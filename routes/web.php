<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('map');
});

Route::get('signin', function(){
    if(auth()->guest()) {
        Auth::attempt(['email' => 'email@dominio.com.br', 'password' => 'esalqusp']);
        return 'Logged in!';
    }
    return 'Already logged in!';
})->name('login');
