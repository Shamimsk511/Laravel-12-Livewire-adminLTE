<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Index as UsersIndex;
use App\Livewire\Brand\Index as BrandsIndex;
use App\Livewire\Category\Index as CategoriesIndex;
use App\Livewire\Setting\Index as SettingsIndex;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/users', UsersIndex::class)->name('users.index');
    Route::get('/brands', BrandsIndex::class)->name('brands.index');
    Route::get('/categories', CategoriesIndex::class)->name('categories.index');
    Route::get('/settings', SettingsIndex::class)->name('settings.index');
});
