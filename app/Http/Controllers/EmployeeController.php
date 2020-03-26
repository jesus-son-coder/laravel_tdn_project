<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emps = Employee::all();
        return view('employees.empmodel')->with('emps', $emps);
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
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        $emps = new Employee;

        $emps->fname = $request->input('fname');
        $emps->lname = $request->input('lname');
        $emps->address = $request->input('address');
        $emps->mobile = $request->input('mobile');

        $emps->save();

        return redirect('/employee')->with('success', 'Data saved');
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
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        $emp = Employee::find($id);

        $emp->fname = $request->input('fname');
        $emp->lname = $request->input('lname');
        $emp->address = $request->input('address');
        $emp->mobile = $request->input('mobile');

        $emp->save();

        return redirect('/employee')->with('success', 'Data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::destroy($id);

        return redirect()->back();
    }
}
