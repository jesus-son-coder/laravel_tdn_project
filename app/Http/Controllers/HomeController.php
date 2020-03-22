<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('excel.customers', compact('users'));
    }

    /**
     * Export the list of Users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

}
