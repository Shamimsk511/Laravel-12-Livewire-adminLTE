<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Index as UsersIndex;
use App\Livewire\Brand\Index as BrandsIndex;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/users', UsersIndex::class)->name('users.index');
    Route::get('/brands', BrandsIndex::class)->name('brands.index');
});
