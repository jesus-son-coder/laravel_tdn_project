<?php

namespace App\Exports;

use App\User;
use App\Exports\UsersPerMonthSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class UsersExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithMultipleSheets
{
    use Exportable;


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
            Date::dateTimeToExcel($user->created_at),
        ];
    }

    /**
     * Ajouter les entêtes des colonnes du fichier à exporter :
     */
    public function headings():array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Created_at'
        ];
    }

    /**
     * Format Specific Columns
     */
    public function columnFormats():array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            //'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

   /**
     * Gérer plusieurs Onglets
     */
    public function sheets():array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new UsersPerMonthSheet($month);
        }

        return $sheets;
    }



}
