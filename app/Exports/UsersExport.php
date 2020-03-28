<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        /* Ne sélectionner que certains champs, avec des conditions particulières : */
        return User::select('id', 'name')->where('id','>',25);
    }
}
