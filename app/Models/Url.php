<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 17/02/2020
 * Time: 02:26
 **/

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    protected $table = 'tdn_urls';

    protected $fillable = ['url', 'shortened'];

    public $timestamps = false;

    
    public static function get_unique_shortened_url()
    {
        $shortened = Str::random(5);

        /*
            Différence entre "static" et "self" :
            "static" : fait référence à la classe qui a appelé la méthode en question.
            "self" : fait référence à la classe au niveau de laquelle on se trouve.
        */
        if(static::where('shortened', $shortened)->count() > 0) {
            static::get_unique_shortened_url();
        }
        // Ainsi, on aurait pu faire :
        /*
        if(self::where('shortened', $shortened)->count() > 0) {
            self::get_unique_shortened_url();
        } */

        return $shortened;
    }
}
