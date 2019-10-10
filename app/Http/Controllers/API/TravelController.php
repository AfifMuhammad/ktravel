<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\TravelCollection;
use App\Travel;

class TravelController extends Controller
{
    public function index()
    {
        //$travels = Travel::orderBy('name', 'DESC');
        $travels = Travel::join('provinces','travels.province','=','provinces.id')
                    ->select('travels.*','provinces.name as province_name')->orderBy('travels.code', 'ASC');
        if (request()->q != '') {
            $travels = $travels->where('travels.name', 'LIKE', '%' . request()->q . '%');
        }
        return new TravelCollection($travels->paginate());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:travels,code',
            'name' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'phone' => 'required|max:13'
        ]);

        Travel::create($request->all());
        return response()->json(['status' => 'success'], 200);
    }

    public function edit($id)
    {
        $travel = Travel::whereCode($id)->first();
        return response()->json(['status' => 'success', 'data' => $travel], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|exists:travels,code',
            'name' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'phone' => 'required|max:13'
        ]);

        $travel = Travel::whereCode($id)->first();
        $travel->update($request->except('code'));
        return response()->json(['status' => 'success'], 200);
    }

    public function destroy($id)
    {
        $travel = Travel::find($id);
        $travel->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
