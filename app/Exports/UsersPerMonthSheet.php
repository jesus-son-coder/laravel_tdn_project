<?php
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Withtitle;

class UsersPerMonthSheet implements FromQuery, WithTitle
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return User
                ::query()
                ->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $this->month);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Month ' . $this->month;
    }

}

