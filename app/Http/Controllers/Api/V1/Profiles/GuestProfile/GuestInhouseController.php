<?php

namespace App\Http\Controllers\Api\V1\Profiles\GuestProfile;

use App\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Requests\GuestInhouseRequest;
use App\Http\Resources\GuestInhouseResource;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestInhouseInterface;

class GuestInhouseController extends Controller
{
    use helpers;

    private $guestInhouseInterface; 

    public function __construct(RepositoryGuestInhouseInterface $guestInhouseInterface)
    {
        $this->guestInhouseInterface =$guestInhouseInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guestInhouse = $this->guestInhouseInterface->index();
        if($guestInhouse->first()){
            return $this->apiResponse(new GeneralCollection($guestInhouse,GuestInhouseResource::class));

        }else
        return $this->apiResponse(["message" => __("not found")]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestInhouseRequest $request)
    {
        $guestInhouse = $this->guestInhouseInterface->store($request);

        return $this->apiResponse(new GeneralCollection($guestInhouse,GuestInhouseResource::class));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guestInhouse = $this->guestInhouseInterface->show($id);
       
        if($guestInhouse){
            return $this->apiResponse(['data' =>collect(new GuestInhouseResource($guestInhouse))]);
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
    public function update(GuestInhouseRequest $request, $id)
    {
        $guestInhouse = $this->guestInhouseInterface->update($request,$id);
        if($guestInhouse){
            
            return $this->apiResponse(new GeneralCollection($guestInhouse,GuestInhouseResource::class));
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
