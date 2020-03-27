<?php

namespace App\Http\Controllers\Test;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Importer;
use Exporter;


class TestController extends Controller
{

    public function importFile()
    {
        return view('test.excel');
    }

    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($validator->passes()){

            $dataTime = date('Ymd_His');
            $file = $request->file('file');
            $fileName = $dataTime . '-' . $file->getClientOriginalName();
            $savePath = public_path('/upload/');
            $file->move($savePath,$fileName);

            $excel = Importer::make('Excel');
            $excel->load($savePath . $fileName);
            $collection = $excel->getCollection();

            // $collection[0] : corresponds à la ligne des intitulés du tableau Excel
            if(sizeof($collection[1]) == 5) {
                for($row=1; $row<sizeof($collection); $row++) {
                    try {
                        var_dump($collection[$row]);
                    } catch(\Exception $e) {
                        return redirect()->back()
                        ->with(['errors' => $e->getMessage()]);
                    }
                }
            } else {
                return redirect()->back()
                        ->with(['errors'=>[0 => 'Please provide data in file according to the sample template']]);
            }
            /*
            return redirect()->back()
                    ->with(['success' => 'File uploaded successfully !']);
            */
        }

        else {
            return redirect()->back()
                    ->with(['errors' => $validator->errors()->all()]);
        }
    }

    public function exportExcel()
    {
        $user = new User();

        $columns = $user->getTableColumns();

        $users = $user->getAll();

        $data = new Collection();
        foreach($columns as $column) {
            $data[0] = (object) $column;
        }
        $data = $data->merge($users);

        $fileName = "Users.xlsx";
        $saveFile = public_path('/download/' . $fileName);

        $excel = Exporter::make('Excel');
        $excel->load($data);
        $excel->save($saveFile);

        $url = url("/download/$fileName");

        $html = '<a href="' . $url . '" id="download" hidden></a>';
        $html .= "<script>document.getElementById('download').click()</script>";

        return $html;

    }

}

