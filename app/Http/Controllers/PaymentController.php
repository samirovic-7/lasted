<?php

namespace App\Http\Controllers;

use App\Models\Payment_type;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json(Payment_type::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'code'                  =>       'integer',
                'name'                  =>       'required|string|max:255',
                'name_loc'              =>       'required|string|max:255',
                'type'                  =>       'string|required',
                'is_cash'               =>       'boolean|nullable',
                'commission_per'        =>       'numeric|nullable',
                'commission_amt'        =>       'numeric|nullable',
                'payment_modes_id'      =>       'nullable|integer',
                'scth_paymentId'        =>       'nullable|integer',

            ]);

            $Payment = Payment_type::create($request->all());

            return response()->json([
                'message' => 'Payment Created Successfully',
                'data' =>  $Payment,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment_type $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment_type $payment)
    {
        $payment = Payment_type::find($payment->id);

        // $paymentTypes = Payment_type::where('id', $payment->id)->with('modes')->get();
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment_type  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment_type $payment)
    {

        try {
            $request->validate([
                'code'                  =>       'integer',
                'name'                  =>       'required|string|max:255',
                'name_loc'              =>       'required|string|max:255',
                'type'                  =>       'string|required',
                'is_cash'               =>       'boolean|nullable',
                'commission_per'        =>       'numeric|nullable',
                'commission_amt'        =>       'numeric|nullable',
                'payment_modes_id'      =>       'nullable|integer',
                'scth_paymentId'        =>       'nullable|integer',

            ]);

            $payment = $payment->update($request->all());

            return response()->json([
                'message'    => 'Payment updated Successfully',
                'data'       =>  $payment,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message'    => 'Validation Error',
                'errors'     => $e->errors(),
            ], 400);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment_type  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment_type $payment)
    {
        $payment->delete();
        return response()->json([
            'message' => 'Payment Deleted Successfully',
        ], 201);
    }
}
