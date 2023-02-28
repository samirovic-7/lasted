<?php
namespace App\Repository\profiles\guestProfile;

use App\Models\guest_profile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GuestProfileRequest;
use App\Repositoryinterface\Profiles\GuestProfile\RepositoryGuestProfileInterface;

class DBrepositoryGuestPrpfile implements RepositoryGuestProfileInterface{
    private $guestProfileModel; 
private $validation;
    public function __construct(guest_profile $guestProfileModel)
    {
        $this->guestProfileModel = $guestProfileModel;
    }

public function index()
{
    $guestProfile = $this->guestProfileModel->with('country')->get();
    return $guestProfile;
}
public function store($request)
{
//    $landlordGuestID = DB::connection('landlord')->table('guest_profiles')->select('id_no')->first();
//     if(!$landlordGuestID){
//         $landlordGuestID = DB::connection('landlord')->table('guest_profiles')->insert($request->all());
//        $tenantGuestID = DB::connection('tenant')->table('guest_profiles')->insert($request->all());
//        $gusetProfile =  $this->guestProfileModel::where('id_no',$request->id_no)->with('country')->get();
//        return $gusetProfile;
//     }else{
//         $tenantGuestID = DB::connection('tenant')->table('guest_profiles')->insert($request->all());
//         $gusetProfile =  $this->guestProfileModel::where('id_no',$request->id_no)->with('country')->get();
//        return $gusetProfile;
//     }
       $tenantGuestID = DB::connection('tenant')->table('guest_profiles')->insert($request->all());
       if(!$tenantGuestID)
       {
        $landlordGuestID = DB::connection('landlord')->table('guest_profiles')->select('id_no')->first();
        if(!$landlordGuestID){
                                $landlordGuestID = DB::connection('landlord')->table('guest_profiles')->insert($request->all());
                                $tenantGuestID = DB::connection('tenant')->table('guest_profiles')->insert($request->all());
                         }else{
                              $tenantGuestID = DB::connection('tenant')->table('guest_profiles')->insert($request->all());
                               }
                  
       }
       $gusetProfile =  $this->guestProfileModel::where('id_no',$request->id_no)->get();
        
        return $gusetProfile;


}
public function show($id)
{  
    $guestProfile = $this->guestProfileModel::where('id_no', $id)->with('country')->first();
    if(!$guestProfile){
        $guestProfile = DB::connection('landlord')->table('guest_profiles')->where('id_no',$id)->select()->first();
    }
    return $guestProfile;
}
public function update($request, $id)
{
   
    $guestProfile = $this->guestProfileModel::where('id_no', $id)->first();
    if($guestProfile){
        $this->guestProfileModel::where('id_no',$id)->Update([
            'Profile_no'  => (!empty($request['Profile_no'])) ? $request['Profile_no'] :  $guestProfile->Profile_no,
            'first_name'  => (!empty($request['first_name'])) ? $request['first_name'] :  $guestProfile->first_name,
            'last_name'  => (!empty($request['last_name'])) ? $request['last_name'] :  $guestProfile->last_name,
            'id_no'  => (!empty($request['id_no'])) ? $request['id_no'] :  $guestProfile->id_no,
            'mobile'  => (!empty($request['mobile'])) ? $request['mobile'] :  $guestProfile->mobile,
            'phone'  => (!empty($request['phone'])) ? $request['phone'] :  $guestProfile->phone,
            'email'  => (!empty($request['email'])) ? $request['email'] :  $guestProfile->email,
            'address'  => (!empty($request['address'])) ? $request['address'] :  $guestProfile->address,
            'country_id'  => (!empty($request['country_id'])) ? $request['country_id'] :  $guestProfile->country_id,
            'city'  => (!empty($request['city'])) ? $request['city'] :  $guestProfile->city,
            'date_of_birth'  => (!empty($request['date_of_birth'])) ? $request['date_of_birth'] :  $guestProfile->date_of_birth,
            'gender'  => (!empty($request['gender'])) ? $request['gender'] :  $guestProfile->gender,
            'created_by'  => (!empty($request['created_by'])) ? $request['created_by'] :  $guestProfile->created_by,
               
        ]);
        DB::connection('landlord')->table('guest_profiles')->where('id_no',$id)->update([
            'Profile_no'  => (!empty($request['Profile_no'])) ? $request['Profile_no'] :  $guestProfile->Profile_no,
            'first_name'  => (!empty($request['first_name'])) ? $request['first_name'] :  $guestProfile->first_name,
            'last_name'  => (!empty($request['last_name'])) ? $request['last_name'] :  $guestProfile->last_name,
            'id_no'  => (!empty($request['id_no'])) ? $request['id_no'] :  $guestProfile->id_no,
            'mobile'  => (!empty($request['mobile'])) ? $request['mobile'] :  $guestProfile->mobile,
            'phone'  => (!empty($request['phone'])) ? $request['phone'] :  $guestProfile->phone,
            'email'  => (!empty($request['email'])) ? $request['email'] :  $guestProfile->email,
            'address'  => (!empty($request['address'])) ? $request['address'] :  $guestProfile->address,
            'country_id'  => (!empty($request['country_id'])) ? $request['country_id'] :  $guestProfile->country_id,
            'city'  => (!empty($request['city'])) ? $request['city'] :  $guestProfile->city,
            'date_of_birth'  => (!empty($request['date_of_birth'])) ? $request['date_of_birth'] :  $guestProfile->date_of_birth,
            'gender'  => (!empty($request['gender'])) ? $request['gender'] :  $guestProfile->gender,
            'created_by'  => (!empty($request['created_by'])) ? $request['created_by'] :  $guestProfile->created_by,
        ]);
        $guestProfile = $this->guestProfileModel::where('id_no',$id)->get();
        return  $guestProfile;
    }else{
        return null;
    }       
}
// public function destroy($id)
// {
//     $room=$this->roomModel::find($id);
//     if($room){
//       $room->delete();
//         return $room;
//     }else{
//         return null;
//     }
// }
// public function geSoftDeletedData()
// {
//    $roomsTrashed = $this->roomModel::onlyTrashed()->get();
//    if($roomsTrashed){
//         return $roomsTrashed;
//    }else{
//         return null;
//    }
    

// }
// public function restorDataTrashed($id)
// {
//     $roomsTrashed = $this->roomModel::where('id', $id)->onlyTrashed()->get();
//     if ($roomsTrashed) {
//         $roomRestored = $this->roomModel::withTrashed()->where('id', $id)->restore();
//         return $roomsTrashed;
//     } else {
//         return null;
//     }
// }


}
