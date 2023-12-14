<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Travel_area;

class TravelAreaController extends Controller
{
    public function list(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'id_company' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false, 'message'=>'', 'errors'=>$validator->errors()], 422,);
            }
            $travelArea = Travel_area::where('id_company', $request->id_company)->get();
            return response()->json(['status'=>true, 'message'=>'Liste des zones de déplacement', 'data' => $travelArea], 200,);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
    }
}
