<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\OperationHold;
use DB;
use Storage;
use Illuminate\Support\Facades\Http;
class SettingController extends Controller
{
    //

    public function import(Request $request)
    {
        DB::unprepared($request->db);
         Payments::where("date","<","2022-04-01")->delete();
         OperationHold::where("date","<","2022-04-01")->delete();
        return "done";
    }

    public function backup()
    {
        $filename = "backup-".date("d-m-Y-H-i-s").".sql";
        $mysqlPath = "mysqldump";

    try{
        $command = "$mysqlPath --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/" . $filename."  2>&1";
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);
        $contents=  file_get_contents(storage_path() . "/" . $filename);

        $response = Http::post('http://womanhealth.hospital/api/importdb', [
            'db' => $contents,
        ]);

        return $response;//ok

     }catch(Exception $e){
        return "0 ".$e->errorInfo; //some error
     }
    }
}
