<?php
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Withtitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersPerMonthSheet implements FromQuery, WithTitle,  WithHeadings, WithEvents
{
    private $month;

    public function __construct(int $month)
    {
        $this->month = $month;
    }


    public function registerEvents():array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        return [
            // Handle by a closure :
            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A1:G1')->applyFromArray($styleArray);
            },
        ];
    }


    /**
     * @return Builder
     */
    public function query()
    {
        return User
                ::query()
                ->where('id','>', 25);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month '. $this->month;
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
            'Created at',
            'Updated at'
        ];
    }

}

