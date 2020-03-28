<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


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
