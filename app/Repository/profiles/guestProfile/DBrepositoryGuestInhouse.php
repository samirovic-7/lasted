<?php
namespace App\Repository\profiles\guestProfile;

use App\Models\GuestInhouse;
use App\Models\guest_profile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GuestProfileRequest;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestInhouseInterface;

class DBrepositoryGuestInhouse implements RepositoryGuestInhouseInterface {
    private $guestInhouseModel; 
    public function __construct(GuestInhouse $guestInhouseModel)
    {
        $this->guestInhouseModel = $guestInhouseModel;
    }

public function index()
{
    $guestInhouse = $this->guestInhouseModel->with(
        'profile',
     //   'company',
        'room',
        'roomTybe',
        'rateCode',
        'marketSegment',
        'sourceBusiness',
        'meal',
        'createdBy',
        )->get();
    return $guestInhouse;
}
public function store($request)
{
    $this->guestInhouseModel::create(
        [
            'folio_no' =>$request->folio_no,
            'in_date' =>$request->in_date,
            'out_date' =>$request->out_date,
            'original_out_date' =>$request->original_out_date,
            'no_of_nights' =>$request->no_of_nights,
            'rm_rate' =>$request->rm_rate,
            'taxes' =>$request->taxes,
            'no_of_pax' =>$request->no_of_pax,
            'hotel_note' =>$request->hotel_note,
            'client_note' =>$request->client_note,
            'way_of_payment' =>$request->way_of_payment,
            'profile_id' =>$request->profile_id,
            'company_id' =>$request->company_id,
            'room_id' =>$request->room_id,
            'room_type_id' =>$request->room_type_id,
            'rate_code_id' =>$request->rate_code_id,
            'market_segment_id' =>$request->market_segment_id,
            'source_of_business_id' =>$request->source_of_business_id,
            'meal_id' =>$request->meal_id,
            'created_by' =>auth()->id(),
            'created_inhousGuest_at' =>$request->created_inhousGuest_at,
            'checked_out' =>$request->checked_out,
            'checkout_by' =>$request->checkout_by,
            'checkout_at' =>$request->checkout_at,
            'is_reservation' =>$request->is_reservation,
            'res_status' =>$request->res_status,
            'is_group' =>$request->is_group,
            'group_code' =>$request->group_code,
            'is_dummy' =>$request->is_dummy,
            'Is_PM' =>$request->Is_PM,
        ]
    );
    $guestInhouse =  $this->guestInhouseModel::where('folio_no',$request->folio_no)->with('profile',
    //   'company',
       'room',
       'roomTybe',
       'rateCode',
       'marketSegment',
       'sourceBusiness',
       'meal',
       'createdBy'
       )->get();
    return  $guestInhouse;


}
public function show($id)
{
   
    $room = $this->guestInhouseModel::where('id', $id)->with( 'profile',
    //   'company',
       'room',
       'roomTybe',
       'rateCode',
       'marketSegment',
       'sourceBusiness',
       'meal',
       'createdBy',)->first();
    return $room;
}
public function update($request, $id)
{
    $guestInhouse = $this->guestInhouseModel::where('id', $id)->first();
    if($guestInhouse){
        $this->guestInhouseModel::where('id',$id)->Update([
            'folio_no'  => (!empty($request['folio_no'])) ? $request['folio_no'] :  $guestInhouse->folio_no,
            'in_date'  => (!empty($request['in_date'])) ? $request['in_date'] :  $guestInhouse->rm_name_loc,
            'out_date'  => (!empty($request['out_date'])) ? $request['out_date'] :  $guestInhouse->rm_max_pax,
            'original_out_date'  => (!empty($request['original_out_date'])) ? $request['original_out_date'] :  $guestInhouse->rm_phone_no,
            'rm_rate'  => (!empty($request['rm_rate'])) ? $request['rm_rate'] :  $guestInhouse->rm_rate,
            'taxes'  => (!empty($request['taxes'])) ? $request['taxes'] :  $guestInhouse->taxes,
            'no_of_pax'  => (!empty($request['no_of_pax'])) ? $request['no_of_pax'] :  $guestInhouse->no_of_pax,
            'hotel_note'  => (!empty($request['hotel_note'])) ? $request['hotel_note'] :  $guestInhouse->hotel_note,
            'client_note'  => (!empty($request['client_note'])) ? $request['client_note'] :  $guestInhouse->client_note,
            'way_of_payment'  => (!empty($request['way_of_payment'])) ? $request['way_of_payment'] :  $guestInhouse->way_of_payment,
            'profile_id'  => (!empty($request['profile_id'])) ? $request['profile_id'] :  $guestInhouse->profile_id,
            'company_id'  => (!empty($request['company_id'])) ? $request['company_id'] :  $guestInhouse->company_id,
            'room_type_id'  => (!empty($request['room_type_id'])) ? $request['room_type_id'] :  $guestInhouse->room_type_id,
            'rate_code_id'  => (!empty($request['room_id'])) ? $request['room_id'] :  $guestInhouse->room_id,
            'market_segment_id'  => (!empty($request['market_segment_id'])) ? $request['market_segment_id'] :  $guestInhouse->market_segment_id,
            'source_of_business_id'  => (!empty($request['source_of_business_id'])) ? $request['source_of_business_id'] :  $guestInhouse->source_of_business_id,
            'meal_id'  => (!empty($request['meal_id'])) ? $request['meal_id'] :  $guestInhouse->meal_id,
            'created_inhousGuest_at'  => (!empty($request['created_inhousGuest_at'])) ? $request['created_inhousGuest_at'] :  $guestInhouse->created_inhousGuest_at,
            'checked_out'  => (!empty($request['checked_out'])) ? $request['checked_out'] :  $guestInhouse->checked_out,
            'checkout_by'  => (!empty($request['checkout_by'])) ? $request['checkout_by'] :  $guestInhouse->checkout_by,
            'checkout_at'  => (!empty($request['checkout_at'])) ? $request['checkout_at'] :  $guestInhouse->checkout_at,
            'is_reservation'  => (!empty($request['is_reservation'])) ? $request['is_reservation'] :  $guestInhouse->is_reservation,
            'res_status'  => (!empty($request['res_status'])) ? $request['res_status'] :  $guestInhouse->res_status,
            'is_group'  => (!empty($request['is_group'])) ? $request['is_group'] :  $guestInhouse->is_group,
            'group_code'  => (!empty($request['group_code'])) ? $request['group_code'] :  $guestInhouse->group_code,
            'is_dummy'  => (!empty($request['is_dummy'])) ? $request['is_dummy'] :  $guestInhouse->is_dummy,
            'room_id'  => (!empty($request['room_id'])) ? $request['room_id'] :  $guestInhouse->room_id,
            'Is_PM'  => (!empty($request['Is_PM'])) ? $request['Is_PM'] :  $guestInhouse->Is_PM,
               
        ]);
        $guestInhouse = $this->guestInhouseModel::where('id',$id)->with( 
            'profile',
        //   'company',
           'room',
           'roomTybe',
           'rateCode',
           'marketSegment',
           'sourceBusiness',
           'meal',
           'createdBy',)->get();
        return  $guestInhouse;
    }else{
        return null;
    }       
}


}
