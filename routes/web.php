<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // rutas
    Volt::route('carreras', 'carreras.index')->name('carreras.index');
    Volt::route('estudiantes', 'estudiantes.index')->name('estudiantes.index');
});

// esto evita que se rompa el proyecto por el archivo auth.php, pues fue complicado con breeze de laravel
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}