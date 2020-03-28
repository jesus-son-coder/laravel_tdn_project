<?php
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Withtitle;

class UsersPerMonthSheet implements FromQuery, WithTitle
{
    private $month;

    public function __construct(int $month)
    {
        $this->month = $month;
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

}

