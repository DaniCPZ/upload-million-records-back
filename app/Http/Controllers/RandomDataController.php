<?php

namespace App\Http\Controllers;

use App\Models\RandomData;
use Illuminate\Http\Request;
use App\Jobs\RandomDataCsvProcess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;

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

            $batch = Bus::batch([])->dispatch();
            foreach($chunks as $key => $chunk){
                $data = array_map('str_getcsv', $chunk);

                if($key === 0 ){
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new RandomDataCsvProcess($data, $header));
            }
            return $batch;
        }
        return 'Please upload file';
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}
