<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRegency(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->data;
            $regency = DB::table('kabupaten')->where('ID_PROVINSI', $id)->get();

            return $regency;
        }
    }

    public function getDistrict(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->data;
            $district = DB::table('kecamatan')->where('ID_KABUPATEN', $id)->get();

            return $district;
        }
    }

    public function getVillage(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->data;
            $village = DB::table('kelurahan')->where('ID_KECAMATAN', $id)->get();

            return $village;
        }
    }
}
