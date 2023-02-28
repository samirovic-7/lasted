<?php

namespace App\Http\Controllers\Api\V1\Profiles\GuestProfile;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Requests\GuestProfileRequest;
use App\Http\Resources\GuestProfileResource;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestProfileInterface;

class GuestProfileController extends Controller
{
    use helpers;

    private $guestProfileInterface; 

    public function __construct(RepositoryGuestProfileInterface $guestProfileInterface)
    {
        $this->guestProfileInterface =$guestProfileInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guestsProfile = $this->guestProfileInterface->index();
        if($guestsProfile->first()){
            return $this->apiResponse(new GeneralCollection($guestsProfile,GuestProfileResource::class));

        }else
        return $this->apiResponse(["message" => __("not found")]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestProfileRequest $request)
    {
        $guestsProfile = $this->guestProfileInterface->store($request);

        return $this->apiResponse(new GeneralCollection($guestsProfile,GuestProfileResource::class));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guestsProfile = $this->guestProfileInterface->show($id);
       
        if($guestsProfile){
            return $this->apiResponse(['data' =>collect(new GuestProfileResource($guestsProfile))]);
        }else{
            return $this->apiResponse(["message" => __("not found")]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuestProfileRequest $request, $id)
    {
        $guestsProfile = $this->guestProfileInterface->update($request,$id);
        if($guestsProfile){
            
            return $this->apiResponse(new GeneralCollection($guestsProfile,GuestProfileResource::class));
        }else{
            return $this->apiResponse(["message" => __("not found")]);
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
        //
    }
}
