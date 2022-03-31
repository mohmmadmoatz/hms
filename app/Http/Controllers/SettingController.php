<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\OperationHold;
use DB;
class SettingController extends Controller
{
    //

    public function import(Request $request)
    {
        DB::unprepared($request->db);
        Payments::where("date","<","2022-03-31")->delete();
        OperationHold::where("date","<","2022-03-31")->delete();
        return "done";
    }
}
