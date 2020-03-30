<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicDependantController extends Controller
{
    public function index()
    {
        $country_list = DB::table('dummy_country_state_city')->select('*')
                            ->groupBy('country')
                            ->get();

        return view('dropdown.dynamic_dependant')->with('country_list', $country_list);
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependant = $request->get('dependant');

        $data = DB::table('dummy_country_state_city')
                    ->where($select, $value)
                    ->groupBy($dependant)
                    ->get();

        $output = '<option value="">Select ' . ucfirst($dependant) . '</option>';

        foreach ($data as $row) {
            $output .= '<option value="' . $row->$dependant . '">' . $row->$dependant . '</option>';
        }
        echo $output;
    }
}
