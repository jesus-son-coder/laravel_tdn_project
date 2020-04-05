<?php

namespace App\Http\Controllers;

use App\AjaxCrud;
use Illuminate\Http\Request;

use Yajra\DataTables;
use Yajra\DataTables\Services\DataTable;

class AjaxCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Si la requête reçue est du type Ajax :
        if(request()->ajax()) {
            // Crée une instance de Datatables :
            return datatables()->of(AjaxCrud::latest()->get())
                        ->addColumn('action', function($data) {
                            $button = '<button type="button"
                                        name="edit" id="' . $data->id . '"
                                        class="edit btn btn-primary btn-sm">
                                        Edit</button>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button"
                                        name="delete" id="' . $data->id . '"
                                        class="delete btn btn-danger btn-sm">
                                        Delete</button>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            ;
        }

        return view ('ajax-datatables/ajax_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
