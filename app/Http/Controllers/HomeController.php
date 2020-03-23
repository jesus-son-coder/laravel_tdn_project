<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
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

    /**
     * Import Users from Excel File.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function import(Request $request)
    {
        // La méthode classique est celle-ci :
        //Excel::import(new UsersImport(), $request->file('import_file'));

        /* Mais pour éviter les cas de Duplicate entry si certains champs sont Uniques (comme les emails), il faut re-traiter les données importées par le fichier Excel avant de les enregistrer en base de données : */
        $users = Excel::toCollection(new UsersImport(), $request->file('import_file'));

        foreach($users[0] as $user) {
            $userAlreadyExist = User::find($user[0]);
            // Si l'utilisateur existe déjà :
            if(null !== $userAlreadyExist) {
                User::where('id', $user[0])->update([
                    'name' => $user[1],
                    'email' => $user[2]
                ]);
            } else {
                $user = new User([
                    'name' => $user[1],
                    'email' => $user[2],
                    'password' => $user[3]
                ]);
                $user->save();
            }

        }

        return redirect()->route('home');
    }


}
