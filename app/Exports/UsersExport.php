<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        /* Ne sélectionner que certains champs, avec des conditions particulières : */
        return User::where('id','>',25);
    }

    /**
     * Map data by adding stuff, modifying or and controlling the content to be exported :
     */
    public function map($user): array
    {
        return [
            'Custom text ' . $user->name,
            $user->email,
        ];
    }

}
