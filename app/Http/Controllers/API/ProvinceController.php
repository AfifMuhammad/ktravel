<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $province = Province::get();
        // if (request()->q != '') {
        //     $province = $province->where('name', 'LIKE', '%' . request()->q . '%');
        // }
        // return new TravelCollection($travels->paginate(10));
        return response()->json(['status' => 'success', 'data' => $province], 200);
    }

}
