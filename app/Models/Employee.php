<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = ['fname', 'lname', 'address', 'mobile'];

    public $timestamps = false;



}
