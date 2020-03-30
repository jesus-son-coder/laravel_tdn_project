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
use Illuminate\Support\Facades\Validator;
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

    // On récupère la valeur du champ 'url' postée depuis le formulaire :
    $requestUrl = request('url');

    // 1- Valider l'url
    $data = ['url' => $requestUrl];

    /* Les différentes règles de validation disponibles de la façade "Validator"
        se trouvent dans la documentation suivante :
        https://laravel.com/docs/5.8/validation#available-validation-rules */

        $validation = Validator::make(
                        $data,
                        ['url' => 'required | url']
                    )->validate();


    // 2- Vérifier si l'url a déjà été raccourcie et la retourner si tel est le cas
    $record = Url::where('url', $requestUrl)->first() ;

    if($record) {
        return view('url-shortener/result')->with('shortened', $record->shortened);
    }

    // 3- Si l'url n'a pas déjà été raccourcie, alors créer une nouvelle short-url, et la retourner.
    $row = Url::create([
        'url' => $requestUrl,
        'shortened' => Url::get_unique_shortened_url()
    ]);

    if($row) {
        return view('url-shortener/result')->with('shortened', $row->shortened);
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


Route::get('/country_state_city', 'DynamicDependantController@index');

Route::post('/dynamic_fetch', 'DynamicDependantController@fetch')->name('dynamicdependant.fetch');
