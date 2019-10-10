<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Regency;

class RegencyController extends Controller
{
    public function index()
    {
        $regencies = Regency::get();
        if (request()->q != '') {
            $regencies = $regencies->where('province_id', request()->q);
        }
        return response()->json(['status' => 'success', 'data' => $regencies], 200);
    }
}
