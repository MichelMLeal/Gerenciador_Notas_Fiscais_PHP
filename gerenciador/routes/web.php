<?php

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

//.. other code

# Import controller
use App\Http\Controllers\ReadXmlController;

Route::match(["get", "post"], "read-xml", [ReadXmlController::class, "index"])->name('xml-upload');

//Route::get('/read-xml', 'ReadXmlController@index')->name('/read-xml');


Route::get('/', function () {
    return view('welcome');
});
