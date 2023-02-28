<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\UseractivityResource;

class ActivitylogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* $activitywithsubject = collect();
        $activitywithoutsubject = collect(); */
        $activities =  UseractivityResource::collection(Activity::all());
        /* foreach ($activities as $activity) {
            if ($activity->subject_type == null) {
                $activitywithsubject->push($activity);

            } else {
                $string = explode('\\', $activity->subject_type);
                $activity_model_name = array_pop($string);
                $username = $activity->subject->firstname.' '.$activity->subject->lastname;
                $activitywithoutsubject->push(['description' => $activity_model_name. ' ' .$activity->description ,'changes'=>$activity->changes]);
            }
        } */
        return response()->json($activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $activity = Activity::findOrFail($id);
        return response()->json($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
