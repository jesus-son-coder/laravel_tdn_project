<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all();

        /* Ne sélectionner que certains champs, avec des conditions particulières : */
        return User::select('id', 'name')->where('id','>',25)->get();
    }
}
