<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Name_site;


class SitesNameController extends Controller
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
            $sites = Name_site::where('id_company', $request->id_company)->get();
            return response()->json(['status'=>true, 'message'=>'Liste des sites', 'data' => $sites], 200,);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
        
    }
}
