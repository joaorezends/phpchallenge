<?php

use App\Presentation\Web\Http\UploadedFilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UploadedFilesController::class, "create"]);
Route::post('/', [UploadedFilesController::class, "store"])
        ->name("files.store");
