<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('map');
});

Route::get('signin', function(){ //sistema automatico de login apenas para testar passport
    if(auth()->guest()) {
        Auth::attempt(['email' => 'email@dominio.com.br', 'password' => 'esalqusp']);
        return 'Logged in!';
    }
    return 'Already logged in!';
})->name('login');