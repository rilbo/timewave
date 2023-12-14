<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken as PersonnalAccessToken;
use App\Models\Companies;
use App\Models\Countries;
use App\Models\Times;
use PHPUnit\Framework\Constraint\Count;



class TimesController extends Controller
{
    public function store(Request $request){
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'date' => 'required|date_format:Y-m-d',
                'work_leave' => 'nullable',
                'sick' => 'nullable',
                'id_name_site_morning' => 'nullable',
                'begin_date_morning' => 'nullable|date_format:H:i:s',
                'end_date_morning' => 'nullable|date_format:H:i:s',
                'id_name_site_afternoon' => 'nullable',
                'begin_date_afternoon' => 'nullable|date_format:H:i:s',
                'end_date_afternoon' => 'nullable|date_format:H:i:s',
                'more_times' => 'nullable',
                'id_travel_zone' => 'nullable',
                'bowl' => 'nullable',
                'id_user' => 'required',
                'id_company' => 'required',
                'done' => 'nullable',
            ]);
            if ($validator->fails()) {
                return response()->json(['status'=>false, 'message'=>'', 'errors'=>$validator->errors()], 422,);
            }
            $times = new Times();
            $times->date = $request->date;
            $times->work_leave = $request->work_leave;
            $times->sick = $request->sick;
            $times->id_name_site_morning = $request->id_name_site_morning;
            $times->begin_date_morning = $request->begin_date_morning;
            $times->end_date_morning = $request->end_date_morning;
            $times->id_name_site_afternoon = $request->id_name_site_afternoon;
            $times->begin_date_afternoon = $request->begin_date_afternoon;
            $times->end_date_afternoon = $request->end_date_afternoon;
            $times->more_times = $request->more_times;
            $times->id_travel_zone = $request->id_travel_zone;
            $times->bowl = $request->bowl;
            $times->id_user = $request->id_user;
            $times->id_company = $request->id_company;
            $times->done = $request->done;
            $times->save();

            return response()->json(['status'=>true, 'message'=>'Ajout avec succés de vos hours', 'data' => $times], 200,);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status'=>false], 500);
        }
    }
}
