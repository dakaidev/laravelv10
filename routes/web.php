<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\EspecialistaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('home'); // Puedes cambiar esto a tu controlador o vista deseada
})->middleware('auth')->name('home');

Route::middleware(['auth'])->group(function () {
    // Rutas para el Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.create_user');
        Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin.store_user');
        
        Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage_users');
        Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUser'])->name('admin.edit_user');
        Route::put('/admin/update-user/{user}', [AdminController::class, 'updateUser'])->name('admin.update_user');
        Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete_user');
        Route::get('/admin/office-documents-count', [AdminController::class, 'viewOfficeDocumentsCount'])->name('admin.office_documents_count');
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

        // Ruta para la búsqueda
        Route::get('/jefe/documents/search', [JefeController::class, 'search'])->name('jefe.documents.search');
        
        // Rutas para ver y descargar documentos
        Route::get('/jefe/documents/{document}', [JefeController::class, 'show'])->name('jefe.documents.show');
        Route::get('/jefe/documents/file/{file}/download', [JefeController::class, 'download'])->name('jefe.documents.download');
    });

    // Rutas para la Secretaria
    Route::middleware(['role:secretaria'])->group(function () {
        Route::get('/secretaria', [SecretariaController::class, 'index'])->name('secretaria.index');
        Route::get('/secretaria/documents', [SecretariaController::class, 'documentsIndex'])->name('secretaria.documents.index');
        Route::get('/secretaria/documents/create', [SecretariaController::class, 'create'])->name('secretaria.documents.create');
        Route::post('/secretaria/documents', [SecretariaController::class, 'store'])->name('secretaria.documents.store');
        Route::get('/secretaria/documents/{document}/edit', [SecretariaController::class, 'edit'])->name('secretaria.documents.edit');
        Route::put('/secretaria/documents/{document}', [SecretariaController::class, 'update'])->name('secretaria.documents.update');

        // Ruta para la búsqueda
        Route::get('/secretaria/documents/search', [SecretariaController::class, 'search'])->name('secretaria.documents.search');
        
        // Rutas para ver y descargar documentos
        Route::get('/secretaria/documents/{document}', [SecretariaController::class, 'show'])->name('secretaria.documents.show');
        Route::get('/secretaria/documents/file/{file}/download', [SecretariaController::class, 'download'])->name('secretaria.documents.download');
    });

    // Rutas para el Especialista
    Route::middleware(['role:especialista'])->group(function () {
        Route::get('/especialista', [EspecialistaController::class, 'index'])->name('especialista.index');
        Route::get('/especialista/documents', [EspecialistaController::class, 'documentsIndex'])->name('especialista.documents.index');
        Route::get('/especialista/documents/create', [EspecialistaController::class, 'create'])->name('especialista.documents.create');
        Route::post('/especialista/documents', [EspecialistaController::class, 'store'])->name('especialista.documents.store');
        Route::get('/especialista/documents/{document}/edit', [EspecialistaController::class, 'edit'])->name('especialista.documents.edit');
        Route::put('/especialista/documents/{document}', [EspecialistaController::class, 'update'])->name('especialista.documents.update');

        // Ruta para la búsqueda
        Route::get('/especialista/documents/search', [EspecialistaController::class, 'search'])->name('especialista.documents.search');
    });
});

require __DIR__.'/auth.php';
