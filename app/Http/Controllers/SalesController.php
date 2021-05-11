<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploadFile');
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
        if (request()->has('mycsv')) {
            // $data =  array_map('str_getcsv', file(request()->mycsv));
            $data   =   file(request()->mycsv);
            // $header = $data[0];
            // unset($data[0]);
            $chunks = array_chunk($data, 1000);
            // $path = resource_path('temp');
            $header = [];

            // creating a batch and dispatch the job
            $batch = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {

                $data = array_map('str_getcsv', $chunk);
                // return $data;
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new SalesCsvProcess($data, $header));

                // SalesCsvProcess::dispatch($data, $header);
            }

            return $batch;
        }

        return 'please upload file';
    }


    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}


// public function store(Request $request)
// {
//     if (request()->has('mycsv')) {
//         // $data =  array_map('str_getcsv', file(request()->mycsv));
//         $data   =   file(request()->mycsv);
//         // $header = $data[0];
//         // unset($data[0]);
//         $chunks = array_chunk($data, 1000);

//         $path = resource_path('temp');

//         // convert 1000 records into a new csv file
//         foreach ($chunks as $key => $chunk) {
//             $name = "/tmp{$key}.csv";
//             file_put_contents($path . $name, $chunk);
//         }

//         $files = glob("$path/*.csv");

//         $header = [];

//         foreach ($files as $key => $file) {

//             $data = array_map('str_getcsv', file($file));
//             if ($key === 0) {
//                 $header = $data[0];
//                 unset($data[0]);
//             }

//             SalesCsvProcess::dispatch($data, $header);
//             // unlink($file);
//         }

//         return 'Stored';
//     }

//     return 'please upload file';
// }
