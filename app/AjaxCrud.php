<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AjaxCrud extends Model
{
    protected $table = '202004_ajax_datatable_cruds';

    // protected $primaryKey = '';

    protected $fillable = [
        'first_name', 'last_name', 'image'
    ];
}
