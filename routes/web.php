<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Models\Url;


Route::get('/', function () {
    return view('welcome');
});


/* ************************* URL-SHORTENER ******************* */

Route::get('/tdn/url-shortener', function () {

    return view('url-shortener/index');

});

// Utilisation du Helper "request()" :
Route::post('/tdn/url-shortener/debug-1', function () {
    // Récupérer la valeur d'un champ posté (ici le champ 'url') depuis un formulaire :
    dd(request('url'));

    // Ou encore :
    dd(request()->get('url'));

    // Ou encore :
    dd(request()->input('url'));

    return view('url-shortener/index');

});

// Il existe un autre moyen pour récupérer l'objet Request et des valeurs postées :
Route::post('/tdn/url-shortener/debug-2', function (Illuminate\Http\Request $request) {

    dd($request->get('url'));
    // ou :
    dd($request->url);

    // On peut aussi utiliser la Facade "Request" :
    dd(Request::get('url'));
    // ou :
    dd(Request::input('url'));

});


/* Le Process :
   ------------
  1- Valider l'url
  2- Vérifier si l'url a déjà été raccourcie et la retourner si tel est le cas
  3- Si l'url n'a pas déjà été raccourcie, alors créer une nouvelle short-url, et la retourner.
  4- Message de succès
*/

Route::post('/tdn/url-shortener', function () {

    $url = Url::where('url', request('url'))->first() ;

    if($url) {
        return view('url-shortener/result')->with('shortened', $url->shortened);
    }

    return view('url-shortener/index');

});

Route::get('/tdn/url-shortener/{shortened}', function ($shortened) {

    $url = Url::where('shortened', $shortened)->first() ;

    if(! $url) {
        return redirect('/tdn/url-shortener/');
    } else {
        return redirect($url->url);
    }

    return view('url-shortener/index');

});
