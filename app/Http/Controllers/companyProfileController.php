<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\companyProfile;
use Illuminate\Validation\ValidationException;

class companyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(companyProfile::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'company_code'         =>'required|unique:company_profiles,company_code|string|max:254',
            'company_name'         =>'required|unique:company_profiles,company_name|max:254',
            'company_name_loc'     =>'required|unique:company_profiles,company_name_loc|max:254',
            'city'                 =>'string',
            'address'              =>'required',
            'phone_1'              =>'numeric|required_without:email',
            'phone_2'              =>'numeric|required_without:email',
            'mobile'               =>'numeric|required',
            'fax'                  =>'required',
            'email'                =>'email|required_without:phone-number',
            'p_o_box'              =>'required',
            'zip_number'           =>'numeric|required',
            'tax_no'               =>'required',
            'contact_person'       =>'required',
            'position'             =>'required',
            'contact_phone'        =>'required',
            'contact_mobile'       =>'required',
            'max_credit_limit'     =>'numeric|required',
            'current_balance'      =>'required',
            'def_rate_code'        =>'string|nullable',
            // 'active'               =>'active',
            'country_id'           =>'integer',

   ]);
 

   $companyProfile= companyProfile::create([
       'company_code'       => $request->company_code,
        'company_name'      =>$request->company_name,
        'company_name_loc'  =>$request->company_name_loc,
        'city'              =>$request->city,
        'address'           =>$request->address,
        'phone_1'           =>$request->phone_1,
        'phone_2'           =>$request->phone_2,
        'mobile'            =>$request->mobile,
        'fax'               =>$request->fax,
        'email'             =>$request->email,
        'p_o_box'           =>$request->p_o_box,
        'zip_number'        =>$request->zip_number,
        'tax_no'            =>$request->tax_no,
        'contact_person'    =>$request->contact_person,
        'position'          =>$request->position,
        'contact_phone'     =>$request->contact_phone,
        'contact_mobile'    =>$request->contact_mobile,
        'max_credit_limit'  =>$request->max_credit_limit,
        'current_balance'   =>$request->current_balance,
        'def_rate_code'     =>$request->def_rate_code,
        // 'active'            =>$request->active,
        'country_id'        =>$request->country_id,
  
   ]);

   return response()->json([
    'message'  => 'Company-Profile Created Successfully',
    'data'     =>  $companyProfile ,
], 201);

} catch (ValidationException $e) {
return response()->json([
    'message' => 'Validation Error',
    'errors'  => $e->errors(),
], 400);

}


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\companyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function show(companyProfile $companyProfile)
    {

        $companyProfile=companyProfile::find($companyProfile->id);
        return response()->json($companyProfile);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\companyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, companyProfile $companyProfile)
    { 
        //dd($companyProfile->id);
        $request->validate([
                'company_code'         => 'required|unique:company_profiles,company_code|string|max:254',
                'company_name'         =>'required|unique:company_profiles,company_name|max:254',
                'company_name_loc'     =>'required|unique:company_profiles,company_name_loc|max:254',
                'city'                 =>'string',
                'address'              =>'required',
                'phone_1'              =>'numeric|required_without:email',
                'phone_2'              =>'numeric|required_without:email',
                'mobile'               =>'numeric|required',
                'fax'                  =>'required',
                'email'                =>'email|required_without:phone-number',
                'p_o_box'              =>'required',
                'zip_number'           =>'numeric|required',
                'tax_no'               =>'required',
                'contact_person'       =>'required',
                'position'             =>'required',
                'contact_phone'        =>'required',
                'contact_mobile'       =>'required',
                'max_credit_limit'     =>'numeric|required',
                'current_balance'      =>'required',
                'def_rate_code'        =>'string|nullable',
                // 'active'               =>'active',
                'country_id'           =>'integer',
       ]);
     

       $companyProfile= companyProfile::where('id',$companyProfile->id)->update([
        
           'company_code'       => $request->company_code,
            'company_name'      =>$request->company_name,
            'company_name_loc'  =>$request->company_name_loc,
            'city'              =>$request->city,
            'address'           =>$request->address,
            'phone_1'           =>$request->phone_1,
            'phone_2'           =>$request->phone_2,
            'mobile'            =>$request->mobile,
            'fax'               =>$request->fax,
            'email'             =>$request->email,
            'p_o_box'           =>$request->p_o_box,
            'zip_number'        =>$request->zip_number,
            'tax_no'            =>$request->tax_no,
            'contact_person'    =>$request->contact_person,
            'position'          =>$request->position,
            'contact_phone'     =>$request->contact_phone,
            'contact_mobile'    =>$request->contact_mobile,
            'max_credit_limit'  =>$request->max_credit_limit,
            'current_balance'   =>$request->current_balance,
            'def_rate_code'     =>$request->def_rate_code,
            // 'active'            =>$request->active,
            'country_id'        =>$request->country_id,
       ]);

      // $companyProfile = companyProfile::where('id',$companyProfile->id)->get();

       return response([
       'message' => 'Company-Profile Updated Successfully',
       'data'    => $companyProfile ,
    ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\companyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyProfile=companyProfile ::where('id',$id)->delete();
        return response()->json([
            'status'     => true,
            'message'    => 'Company-Profile Deleted Successfully',
        ],201);
    }
}
