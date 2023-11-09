<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Times;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $times = Times::all();
        return response()->json($times);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'work_leave' => 'nullable|boolean',
            'sick' => 'nullable|boolean',
            'id_name_site_morning' => 'required|integer',
            'begin_date_morning' => 'required|date',
            'end_date_morning' => 'required|date',
            'id_name_site_afternoon' => 'required|integer',
            'begin_date_afternoon' => 'required|date',
            'end_date_afternoon' => 'required|date',
            'more_times' => 'nullable|integer',
            'bowl' => 'nullable|boolean',
            'id_user' => 'required|integer',
            'id_company' => 'required|integer',
            'done' => 'nullable|boolean',
            'data' => 'nullable|object',
        ]);

        $time = Times::create([
            'work_leave' => $request->work_leave,
            'sick' => $request->sick,
            'id_name_site_morning' => $request->id_name_site_morning,
            'begin_date_morning' => $request->begin_date_morning,
            'end_date_morning' => $request->end_date_morning,
            'id_name_site_afternoon' => $request->id_name_site_afternoon,
            'begin_date_afternoon' => $request->begin_date_afternoon,
            'end_date_afternoon' => $request->end_date_afternoon,
            'more_times' => $request->more_times,
            'bowl' => $request->bowl,
            'id_user' => $request->id_user,
            'id_company' => $request->id_company,
            'done' => $request->done,
            'data' => $request->data,
        ]);

        return response()->json([
            'message' => 'Time created successfully',
            'time' => $time
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $time = Times::find($id);
        if (!$time) {
            return response()->json([
                'message' => 'Time not found'
            ], 404);
        }
        return response()->json($time);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $time = Times::find($id);
        if (!$time) {
            return response()->json([
                'message' => 'Time not found'
            ], 404);
        }

        $time->work_leave = $request->work_leave;
        $time->sick = $request->sick;
        $time->id_name_site_morning = $request->id_name_site_morning;
        $time->begin_date_morning = $request->begin_date_morning;
        $time->end_date_morning = $request->end_date_morning;
        $time->id_name_site_afternoon = $request->id_name_site_afternoon;
        $time->begin_date_afternoon = $request->begin_date_afternoon;
        $time->end_date_afternoon = $request->end_date_afternoon;
        $time->more_times = $request->more_times;
        $time->bowl = $request->bowl;
        $time->id_user = $request->id_user;
        $time->id_company = $request->id_company;
        $time->done = $request->done;
        $time->data = $request->data;

        $time->save();

        return response()->json([
            'message' => 'Time updated successfully',
            'time' => $time
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $time = Times::find($id);
        if (!$time) {
            return response()->json([
                'message' => 'Time not found'
            ], 404);
        }

        $time->delete();

        return response()->json([
            'message' => 'Time deleted successfully'
        ]);
    }
}
