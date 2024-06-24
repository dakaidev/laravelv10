<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\SecretariaController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Asegúrate de que esta ruta exista
Route::get('/home', function () {
    return view('home'); // Puedes cambiar esto a tu controlador o vista deseada
})->middleware('auth')->name('home');

Route::middleware(['auth'])->group(function () {
    // Rutas para el Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create-user', [AdminController::class, 'create_user'])->name('admin.create_user');
        Route::post('/admin/store-user', [AdminController::class, 'store_user'])->name('admin.store_user');
        // Rutas para gestionar documentos
        Route::get('/admin/documents', [AdminController::class, 'documents_index'])->name('admin.documents.index');
        Route::get('/admin/documents/create', [AdminController::class, 'documents_create'])->name('admin.documents.create');
        Route::post('/admin/documents', [AdminController::class, 'documents_store'])->name('admin.documents.store');
        Route::get('/admin/documents/{document}/edit', [AdminController::class, 'documents_edit'])->name('admin.documents.edit');
        Route::put('/admin/documents/{document}', [AdminController::class, 'documents_update'])->name('admin.documents.update');
        Route::delete('/admin/documents/{document}', [AdminController::class, 'documents_destroy'])->name('admin.documents.destroy');
    });

    // Rutas para el Jefe
    Route::middleware(['role:jefe'])->group(function () {
        Route::get('/jefe', [JefeController::class, 'index'])->name('jefe.index');
        Route::get('/jefe/documents', [JefeController::class, 'documentsIndex'])->name('jefe.documents.index');
        Route::get('/jefe/documents/create', [JefeController::class, 'create'])->name('jefe.documents.create');
        Route::post('/jefe/documents', [JefeController::class, 'store'])->name('jefe.documents.store');
        Route::get('/jefe/documents/{document}/edit', [JefeController::class, 'edit'])->name('jefe.documents.edit');
        Route::put('/jefe/documents/{document}', [JefeController::class, 'update'])->name('jefe.documents.update');
        Route::delete('/jefe/documents/{document}', [JefeController::class, 'destroy'])->name('jefe.documents.destroy');
    });

    // Rutas para la Secretaria
    Route::middleware(['role:secretaria'])->group(function () {
        Route::get('/secretaria', [SecretariaController::class, 'index'])->name('secretaria.index');
        Route::get('/secretaria/documents', [SecretariaController::class, 'documentsIndex'])->name('secretaria.documents.index');
        Route::get('/secretaria/documents/create', [SecretariaController::class, 'create'])->name('secretaria.documents.create');
        Route::post('/secretaria/documents', [SecretariaController::class, 'store'])->name('secretaria.documents.store');
        Route::get('/secretaria/documents/{document}/edit', [SecretariaController::class, 'edit'])->name('secretaria.documents.edit');
        Route::put('/secretaria/documents/{document}', [SecretariaController::class, 'update'])->name('secretaria.documents.update');
    });
});

require __DIR__.'/auth.php';
