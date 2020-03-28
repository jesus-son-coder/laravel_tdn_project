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
    private $numberRows;

    public function __construct(int $month, int $numberRows)
    {
        $this->month = $month;
        $this->numberRows = $numberRows;
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

                // Calcul de la position de la ligne où la somme se trouvera dans le tableau
                $i = $this->numberRows + 2;

                // Récupération dynamique du nombre de lignes à additionner
                $j = $this->numberRows + 1;

                $starter = 'A' . $i;
                $sum = '=SUM(A2:A' . $j . ')';

                $event->sheet->setCellValue($starter, $sum);
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

