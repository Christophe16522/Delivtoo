<?php

use App\Basket;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

// Front end routes
Route::get('/', function () {
    return redirect('tarifs-de-livraison');
});
Route::get('/login', function () {
    return view('front_end.login');
});
Route::get('/register', function () {
    return view('front_end.register');
});
Route::get('/tarifs-de-livraison', 'FrontEndController@tarif_de_livraison');
Route::get('/options-de-livraison', 'FrontEndController@options_de_livraison');
Route::get('/supprimer-du-pannier/{n_commande}', 'FrontEndController@delete_order_basket');
Route::get('/save-is-etage/{id_basket_delivery}/{state}', 'FrontEndController@save_is_etage');
Route::get('/save-is-piece-choice/{id_basket_delivery}/{state}', 'FrontEndController@save_is_piece');
Route::get('/get-total-basket/{id_basket}', 'FrontEndController@get_total_basket');
Route::post('/commander-livraison', 'FrontEndController@commander_livraison');
// End Front end routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-ip', function () {
    dd(request()->getClientIp());
});
Route::get('test-havebasket-byip', function () {
    dd(Basket::have_basket_by_ip('127.0.0.1'));
});
Route::get('test-uudi', function () {
    $uuid = Str::uuid()->toString();
    dd($uuid);
});