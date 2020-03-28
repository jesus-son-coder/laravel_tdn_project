<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithMapping, WithHeadings
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
            $user->id,
            'Custom text ' . $user->name,
            $user->email,
        ];
    }

    /**
     * Ajouter les entêtes des colonnes au fichier à exporter :
     */
    public function headings():array
    {
        return [
            'Id',
            'Name',
            'Email'
        ];
    }

}
