<?php

use Illuminate\Support\Facades\Route;
use App\Modules\JohnmarCRUD\Controller\CrudController;

/*
|--------------------------------------------------------------------------
| JohnmarCRUD Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module.
| These routes are mapped to the CrudController methods to handle requests.
|
*/

// GET route to display the main index page (list of items and the Add form modal)
Route::get('/johnmar-crud', [CrudController::class, 'index'])->name('johnmarcrud.index');

// POST route to handle form submission for creating a new item
Route::post('/johnmar-crud', [CrudController::class, 'store'])->name('johnmarcrud.store');

// GET route to display the edit modal for a specific item ID. 
// Uses a closure to manually invoke the controller method.
Route::get('/johnmar-crud/{id}/edit', function ($id) {
    return app(CrudController::class)->edit($id);
})->name('johnmarcrud.edit');

// PUT route to handle the form submission for updating an existing item.
// Uses a closure to inject the Request object and pass both to the controller.
Route::put('/johnmar-crud/{id}', function ($id, \Illuminate\Http\Request $request) {
    return app(CrudController::class)->update($request, $id);
})->name('johnmarcrud.update');

// DELETE route to handle the removal of a specific item by its ID.
Route::delete('/johnmar-crud/{id}', function ($id) {
    return app(CrudController::class)->destroy($id);
})->name('johnmarcrud.destroy');
