<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::match(['get', 'post'], '/login', [SecurityController::class, 'login']);
Route::match(['get', 'post'], '/register', [SecurityController::class, 'register']);
Route::match(['get', 'post'], '/logout', [SecurityController::class, 'logout']);
Route::match(['get', 'post'], '/is_logged_in', [SecurityController::class, 'isLoggedIn']);

// Rute untuk menempilkan semua checklists
Route::get('/checklists', [ChecklistController::class, 'index']);
// Rute untuk menempilkan detail checklists
Route::get('/checklists/show/{id}', [ChecklistController::class, 'show']);
// Rute untuk menghapus checklists berdasarkan id
Route::get('/checklists/delete/{id}', [ChecklistController::class, 'destroy']);
// Rute untuk membuat checklists 
Route::match(['get', 'post'], '/checklists/create', [ChecklistController::class, 'store']);

// Rute untuk membuat item di dalam checklist
Route::match(['get', 'post'], '/checklists/{checklistId}/items/create', [ChecklistItemController::class, 'store']);
// Rute untuk menampilkan detail item di dalam checklist
Route::get('/checklists/{checklistId}/items/{itemId}', [ChecklistItemController::class, 'show']);
// Rute untuk mengubah item di dalam checklist
Route::get('/checklists/{checklistId}/items/update/{itemId}', [ChecklistItemController::class, 'update']);
// Rute untuk mengubah status item di dalam checklist
Route::get('/checklists/{checklistId}/items/update_status/{itemId}', [ChecklistItemController::class, 'updateStatus']);
// Rute untuk menghapus item di dalam checklist
Route::get('/checklists/{checklistId}/items/delete/{itemId}', [ChecklistItemController::class, 'destroy']);


/*
http://127.0.0.1:8000/api/logout
http://127.0.0.1:8000/api/login?username=fahmi&password=123456
http://127.0.0.1:8000/api/is_logged_in
http://127.0.0.1:8000/api/register?email=fahmifebriandri@gmail.com&username=fahmi&password=123456

http://127.0.0.1:8000/api/checklists/create?title=judul%20pesan%20saya
http://127.0.0.1:8000/api/checklists/delete/2
*/

