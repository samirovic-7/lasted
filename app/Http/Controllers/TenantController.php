<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


//use Spatie\FlareClient\Http\Response;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tenanat = Tenant::all();
        return response()->json($tenanat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'clientname' => 'required|max:20',
            'tenantname' => 'required|max:20',
            'domain' => 'required|max:20|unique',
            'database' => 'required'|'unique',
            'email' => 'email|required_without:phonenumber',
            'phonenumber' => 'numeric|required_without:email',
            'address'=>'required'

        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors(),
            ], 401);
        }

        Tenant::create([
            'clientname'    => $request->clientname,
            'tenantname'    => $request->tenantname,
            'domain'        => $request->domain,
            'database'      => $request->database,
            'phonenumber'   => $request->phonenumber,
            'address'       => $request->address,
            'taxnumber'     =>$request->taxnumber,


        ]);
        return response()->json([
            'status' => true,
            'message' => 'Welcome To Our Site',
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {

        $tenanat = Tenant::all();
        return response()->json($tenanat);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validateUser = Validator::make($request->all(), [
            'clientname' => 'required|max:20',
            'tenantname' => 'required|max:20',
            'domain' => 'required|max:20|unique',
            'database' => 'required'|'unique',
            'email' => 'email|required_without:phonenumber',
            'phonenumber' => 'numeric|required_without:email',
            'address'=>'required'

        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors(),
            ], 401);
        }

        Tenant::update([
            'clientname'    => $request->clientname,
            'tenantname'    => $request->tenantname,
            'domain'        => $request->domain,
            'database'      => $request->database,
            'phonenumber'   => $request->phonenumber,
            'address'       => $request->address,
            'taxnumber'     =>$request->taxnumber,


        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data Updated Successfully',
        ], 401);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return response()->json([
            'status' => true,
            'message' => 'Tenant Deleted Successfully',
        ], 200);
    }
}