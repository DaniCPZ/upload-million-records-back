<?php

namespace App\Http\Controllers;

use App\Models\RandomData;
use Illuminate\Http\Request;

class RandomDataController extends Controller
{
    public function index()
    {
    	return view('upload-file');
    }

    public function store()
    {
        if(request()->hasfile('mycsv')){
            $data = array_map('str_getcsv', file(request()->mycsv));
            $header = $data[0];
            unset($data[0]);

            foreach($data as $value){
                $randomData = array_combine($header, $value);
                RandomData::create($randomData);
            }

            return 'Done';
        }
        return 'Please upload file';
    }
}
