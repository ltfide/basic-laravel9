<?php

use App\Http\Controllers\BladeController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProvisionController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loopy', function () {
    return "<h1 style='color: royalblue;'>Lutfi Dendiansyah</h1>";
});

Route::redirect('/youtube', '/loopy');

Route::fallback(function () {
    return "404 url not found";
});

Route::get('/hello', function () {
    return view('hello', ['name' => 'lutfi']);
});

Route::get('/product/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/product/{id}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/category/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+');

Route::get('/conflict/lutfi', function () {
    return "User Lutfi Dendiansyah";
});

Route::get('/conflict/{name}', function ($name) {
    return "User $name";
});

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'home']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [InputController::class, 'helloInputAll']);
Route::post('/input/hello/array', [InputController::class, 'helloArray']);
Route::get('/input/hello/query', [InputController::class, 'helloQuery']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'fileUpload']);

Route::get('/response/hello', [ResponseController::class, 'hello']);
Route::get('/response/header', [ResponseController::class, 'header']);
Route::get('/response/view', [ResponseController::class, 'view']);
Route::get('/response/json', [ResponseController::class, 'json']);
Route::get('/response/file', [ResponseController::class, 'file']);
Route::get('/response/download', [ResponseController::class, 'download']);

Route::prefix('/cookie')->group(function () {
    Route::get('/set', [CookieController::class, 'createCookie']);
    Route::get('/get', [CookieController::class, 'getCookie']);
    Route::get('/clear', [CookieController::class, 'clearCookie']);
});

Route::controller(RedirectController::class)->group(function () {
    Route::get('/redirect/to', 'redirectTo');
    Route::get('/redirect/from', 'redirectFrom');
    Route::get('/redirect/name', 'redirectName');
    Route::get('/redirect/action', 'redirectAction');
    Route::get('/redirect/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('/redirect/named', function() {
        // return route('redirect-hello', ['name' => 'lutfi']);
        // return url()->route('redirect-hello', ['name' => 'lutfi']);
        return URL::route('redirect-hello', ['name' => 'lutfi']);
    });
    Route::get('/redirect/away', 'redirectAway');
});

Route::middleware(['contoh:loopy, 401'])->group(function () {
    Route::get('/middleware/api', function () {
        return 'OK';
    });
    
    Route::get('/middleware/group', function () {
        return 'GROUP';
    });
});

Route::get('/url/action', function () {
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'SubmitForm']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/sample/error', function () {
    throw new Exception('Sample Error');
});

Route::get('/sample/manual', function () {
    report(new Exception('Sample Error'));
    return 'OK';
});




// Blade

Route::get('/blade/if', [BladeController::class, 'ifStatements']);
Route::get('/blade/switch', [BladeController::class, 'switchStatements']);
Route::get('/blade/loops', [BladeController::class, 'loops']);
Route::get('/blade/classes', [BladeController::class, 'classes']);

// controller 

Route::post('/server', ProvisionController::class);

Route::get('/photos/popular', [PhotoController::class, 'popular']);
Route::resource('photos', PhotoController::class)
    ->missing(function (Request $request) {
        return Redirect::route('photos.index');
    });


Route::get('/request', function (Request $request) {
    $request->header('user', 'lutfi');
    // return $request->header('cookie');
    // return $request->bearerToken();
});

Route::post('/request/input', function (Request $request) {
    return $request->input('name', 'lutfi');
}); 

Route::post('/request/bool', function (Request $request) {
    return $request->boolean('checkbox');
});

Route::get('/request/file', function () {
    return view('gambar');
});

Route::post('/request/file', function (Request $request) {
    // return $request->file('gambar')->getClientOriginalName();
    // return $request->file('gambar')->storeAs('images', $request->file('gambar')->getClientOriginalName());
});