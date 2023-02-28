<?php

namespace App\Http\Controllers\Api\V1\Rooms;

use App\helpers;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\Rooms\RoomResource;
use App\Repositoryinterface\Rooms\RepositoryRoomInterface;

use function PHPUnit\Framework\isEmpty;

class RoomController extends Controller
{
    use helpers;

    private $RepositoryRoomInterface;

    public function __construct(RepositoryRoomInterface $RepositoryRoomInterface)
    {
        $this->RepositoryRoomInterface =$RepositoryRoomInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = $this->RepositoryRoomInterface->index();
        if($rooms->first()){
            return $this->apiResponse(new GeneralCollection($rooms,RoomResource::class));

        }else
            return $this->apiResponse(["message" => __("not found")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {

        $rooms = $this->RepositoryRoomInterface->store($request);

        return $this->apiResponse(new GeneralCollection($rooms,RoomResource::class));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = $this->RepositoryRoomInterface->show($id);

        if($room){
            return $this->apiResponse(['data' =>collect(new RoomResource($room))]);
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
    public function update(RoomRequest $request, $id)
    {
        $room = $this->RepositoryRoomInterface->update($request,$id);
        if($room){

            return $this->apiResponse(new GeneralCollection($room,RoomResource::class));
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
        $room = $this->RepositoryRoomInterface->destroy($id);

        if($room){
            return $this->apiResponse(["message" => __("the Room Has Been Deleted")]);
        }else{
            return $this->apiResponse(['message' =>__("not found")], 404);
        }
    }

    public function geSoftDeletedData()
    {
        $roomsTrashed = $this->RepositoryRoomInterface->geSoftDeletedData();

        if($roomsTrashed->first()){
            return $this->apiResponse(new GeneralCollection($roomsTrashed,RoomResource::class));
        }else{
            return $this->apiResponse(["message" => __("not found")],404);
        }
    }

    public function restorDataTrashed($id)
    {
        $roomRestore = $this->RepositoryRoomInterface->restorDataTrashed($id);

        if($roomRestore->first()){
            return $this->apiResponse(new GeneralCollection($roomRestore,RoomResource::class));
        }else{
            return $this->apiResponse(["message" => __("not found")],404);
        }

    }

}
