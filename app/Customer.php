<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'tbl_customer';

    protected $primaryKey = 'CustomerID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country'
    ];

    public $timestamps = false;

}
