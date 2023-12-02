<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');
Route::post('/guardar-productos', [ProductoController::class, 'store'])->name('producto.store');
Route::get('/importar', [ProductoController::class, 'viewImport'])->name('producto.viewimport');
Route::post('/getproducto', [ProductoController::class, 'getProducto'])->name('producto.getProducto');
Route::post('/importar-productos', [ProductoController::class, 'importProduct'])->name('producto.importar');
Route::get('/producto/{id}/editar-productos', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{id}/actualizar-productos', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/{id}/eliminar-productos', [ProductoController::class, 'destroy'])->name('producto.destroy');

