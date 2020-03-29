<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Customer;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class ImportExcelController extends Controller
{
    public function index()
    {
        $data = DB::table('tbl_customer')->orderBy('CustomerID', 'DESC')->get();

        return view('excel.import_excel', compact('data'));
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx'
        ]);

        try {
            $customers = Excel::toCollection(new CustomersImport(), $request->file('select_file'));
        } catch(Exception $e) {
            return redirect()->route('importExcelDisplay');
            exit;
        }

        foreach($customers[0] as $customer) {

            $customer = new Customer([
                'CustomerName' => $customer[0],
                'Gender' => $customer[1],
                'Address' => $customer[2],
                'City' => $customer[3],
                'PostalCode' => $customer[4],
                'Country' => $customer[5],
            ]);

            $customer->save();
        }

        return back()->with('success', 'Excel Data Imported successfully.');
    }

}
