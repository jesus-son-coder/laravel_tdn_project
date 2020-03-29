<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'CustomerName' => $row[1],
            'Gender' => $row[2],
            'Address' => $row[3],
            'City' => $row[4],
            'PostalCode' => $row[5],
            'Country' => $row[6],
        ]);
    }
}
