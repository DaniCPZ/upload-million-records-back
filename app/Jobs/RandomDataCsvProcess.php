<?php

namespace App\Jobs;

use App\Models\RandomData;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RandomDataCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public $data,
        public $header,
    ){}

    public function handle(): void
    {
        foreach($this->data as $value){
            $randomData = array_combine($this->header, $value);
            RandomData::create($randomData);
        }
    }
}
