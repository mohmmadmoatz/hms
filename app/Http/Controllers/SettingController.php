<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SettingController extends Controller
{
    //

    public function import(Request $request)
    {
        DB::unprepared($request->db);
        return response()->json($request->db, 200);
    }
}
