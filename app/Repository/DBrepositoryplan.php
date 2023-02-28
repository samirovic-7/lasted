<?php
namespace App\Repository;

use Illuminate\Support\Facades\DB;
use LucasDotVin\Soulbscription\Models\Plan;
use LucasDotVin\Soulbscription\Models\Feature;
use LucasDotVin\Soulbscription\Models\FeaturePlan;
use App\Repositoryinterface\Repositoryplaninterface;
use LucasDotVin\Soulbscription\Enums\PeriodicityType;
use App\Http\Controllers\Api\V1\Subscription\PlanController;

class DBrepositoryplan implements Repositoryplaninterface{
    private $planModel; 

    public function __construct(Plan $planModel)
    {
        $this->planModel = $planModel;
    }
   
    public function index()
    {
        $plan = $this->planModel::get();
        return $plan;
    }

    public function geSoftDeletedData()
    {
       $planTrashed = $this->planModel::onlyTrashed()->get();
       if($planTrashed){
            return $planTrashed;
       }else{
            return null;
       }
        

    }

    public function restorDataTrashed($id)
    {
        $planTrashed = $this->planModel::where('id', $id)->onlyTrashed()->get();
        if ($planTrashed) {
            $PlanRestored = $this->planModel::withTrashed()->where('id', $id)->restore();
            return $planTrashed;
        } else {
            return null;
        }
    }
    public function store($request)
    {
        $periodicity_type=$request->periodicity_type;
        $this->planModel::create([
            'name'             => $request->name,
            'periodicity_type' => $periodicity_type,
            'periodicity'      => $request->periodicity,
        ]);
        $plan = $this->planModel::where('name',$request->name)->get();
        return  $plan;
    }

    public function show($id)
    {      
        $planFeature = $this->planModel::where('id', $id)->with('features')->first();
        return $planFeature;
    }

    public function update($request, $id)
    {
        $periodicity_type=$request->periodicity_type;
        $plans = $this->planModel::where('id', $id)->first();
        if($plans){
            $this->planModel::where('id',$id)->Update([
                'name'  => (!empty($request['name'])) ? $request['name'] :  $plans->name,
                'periodicity_type' => (!empty($request->periodicity_type)) ? $request->periodicity_type :  $plans->periodicity_type,
                'periodicity'      => (!empty($request->periodicity)) ? $request->periodicity :  $plans->periodicity,        
            ]);
            $plan = $this->planModel::where('id',$id)->get();
            return  $plan;
        }else{
            return null;
        }       
        
    }


    public function createPlanFeature($request,$planID)   
     {
        $plan = $this->planModel::where('id', $planID)->first();
        $feature = Feature::where('id', $request->id)->get();
        if($plan){
            if($plan && $feature->first() !=null ||$request->featureID){
                $featurePlan = $plan->features()->sync(
                     $request->get('featureID'),    
                    );
                $planFeature = $this->planModel::where('id', $planID)->with('features')->get();
                return $planFeature;
            }
        }
      else{
            return null;
        }
    
     }

    public function destroy($id)
    {
        $plan=$this->planModel::find($id);
        if($plan){
          $plan->delete();
            return $plan;
        }else{
            return null;
        }
    }

    public function DBDelete($id)
    {
        $plan=$this->planModel::withTrashed()->find($id);
        if($plan){
          DB::table('plans')->where('id', $id)->delete();
            return $plan;
        }else{
            return null;
        }

    }

}

