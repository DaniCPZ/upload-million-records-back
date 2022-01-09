<?php

namespace App\Http\Controllers;

use App\Jobs\RandomDataCsvProcess;
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

            $chunks = array_chunk($data, 1000);

            $header = [];
            foreach($chunks as $key => $chunk){
                $data = array_map('str_getcsv', $chunk);

                if($key === 0 ){
                    $header = $data[0];
                    unset($data[0]);
                }

                RandomDataCsvProcess::dispatch($data, $header);
            }
            return 'Done';
        }
        return 'Please upload file';
    }
}
