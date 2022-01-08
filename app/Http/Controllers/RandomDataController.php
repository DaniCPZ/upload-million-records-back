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

    public function upload()
    {
        if(request()->hasfile('mycsv')){
            $data = file(request()->mycsv);
            // chunking file
            $chunks = array_chunk($data, 1000);
            // convert 1000 records into a new csv file
            foreach($chunks as $key => $chunk){
                $name = "/tmp_{$key}.csv";
                $path = resource_path('temp');
                file_put_contents($path.$name, $chunk);
            }
            return 'Done';
        }
        return 'Please upload file';
    }

    public function store()
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");

        $header = [];
        foreach($files as $key => $file){
            $data = array_map('str_getcsv', file($file));

            if($key === 0 ){
                $header = $data[0];
                unset($data[0]);
            }

           foreach($data as $value){
                $randomData = array_combine($header, $value);
                RandomData::create($randomData);
            }
            unlink($file);
        }

        return 'stored';
    }
}
