<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
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
            $regency = Regency::where('ID_PROVINSI', $id)->get();

            return $regency;
        }
    }

    public function getDistrict(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->data;
            $district = District::where('ID_KABUPATEN', $id)->get();

            return $district;
        }
    }

    public function getVillage(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->data;
            $village = Village::where('ID_KECAMATAN', $id)->get();

            return $village;
        }
    }
}
