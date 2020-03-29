<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ImportExcelController extends Controller
{
    function index()
    {
        $data = DB::table('tbl_customer')->orderBy('CustomerID', 'DESC')->get();
        // dd($data);
        return view('excel.import_excel', compact('data'));
    }
}
