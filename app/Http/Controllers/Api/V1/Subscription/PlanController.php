<?php

namespace App\Http\Controllers\Api\V1\Subscription;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Planresource;
use App\Http\Resources\GeneralCollection;
use LucasDotVin\Soulbscription\Models\Plan;
use App\Repositoryinterface\Repositoryplaninterface;

class PlanController extends Controller
{
    use helpers;
    public $planInterface;

    public function __construct(Repositoryplaninterface $Repositoryplaninterface)
    {
        $this->planInterface = $Repositoryplaninterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->planInterface->index();
        if($plans->first()){
            return $this->apiResponse(new GeneralCollection($plans,Planresource::class));
        }else{
            return $this->apiResponse(["message" => __("not found")],404);
        }

    }

    public function geSoftDeletedData()
    {
       $planTrashed = $this->planInterface->geSoftDeletedData();
       
       if($planTrashed->first()){
        return $this->apiResponse(new GeneralCollection($planTrashed,Planresource::class));
       }else{
        return $this->apiResponse(["message" => "not found"],404);
       }
    }

    public function restorDataTrashed($id)
    {
        $planRestore = $this->planInterface->restorDataTrashed($id);
       
    if($planRestore->first()){
        return $this->apiResponse(new GeneralCollection($planRestore,Planresource::class));
    }else{
        return $this->apiResponse(["message" => "not found"],404);
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $plans = $this->planInterface->store($request);
       
            $planID = $plans->first()->id;
           
        $plansFeature = $this->planInterface->createPlanFeature($request,$planID);

    return $this->apiResponse(new GeneralCollection($plans,Planresource::class));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $plans = $this->planInterface->show($id);
       
    if($plans){
            
        return Planresource::make($plans);
    }else{
        return $this->apiResponse(["message" => "not found"]);
    }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        $plans = $this->planInterface->update($request,$id);
        if($plans){
            
            return $this->apiResponse(new GeneralCollection($plans,Planresource::class));
        }else{
            return $this->apiResponse(["message" => "not found"]);
        }

       
    }

    /**
     * Associating Plans with Features
     *
     * @param  int  $id,$request
     * @return \Illuminate\Http\Response
     */

     public function createPlanFeature(PlanRequest $request,$planID)
     {
      
        $planFeature = $this->planInterface->createPlanFeature($request,$planID);
      //  dd($planFeature);
        if($planFeature){
           // return $this->apiResponse(new Planresource($planFeature));
            return $this->apiResponse(new GeneralCollection($planFeature,Planresource::class));
        }else{
            return $this->apiResponse(["message" => "not found"]);
        }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = $this->planInterface->destroy($id);
           
        if($plan){
            return $this->apiResponse(["message" => "the Plan Has Been Deleted"]);
        }else{
            return $this->apiResponse(['message' => 'not found'], 404);
        }
    }

    public function DBDelete($id)
    {
        $plan = $this->planInterface->DBDelete($id);
           
        if($plan){
            return $this->apiResponse(["message" => "the Plan Has Been Deleted from database"]);
        }else{
            return $this->apiResponse(['message' => 'not found'], 404);
        }
    }

}
