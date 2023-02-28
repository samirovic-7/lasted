<?php

namespace App\Http\Controllers;

use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Statement::all());
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
                'invoice_no'                 =>'required|unique:statements,invoice_no|string|max:254',
                'folio_no'                   =>'required|unique:statements,folio_no',
                'company_id'                 =>'integer',
                'trans_date'                 =>'required|date_format:Y/m/d',
                'trans_no'                   =>'required|string',
                'trans_type'                 =>'required',
                'ref_no'                     =>'numeric|required',
                'description'                =>'required',
                'debit_amount'               =>'required',
                'credit_amount'              =>'required',
                'created_by'                 =>'integer',
                'void'                       =>'required',
                'void_datetime'              =>'required|date_format:Y/m/d',
                
    
       ]);
     
    
       $companyStatement= Statement::create([
            'invoice_no'         => $request-> invoice_no,
            'folio_no'           =>$request->folio_no,
            'company_id'         =>$request->company_id,
            'trans_date'         =>$request->trans_date,
            'trans_no'           =>$request->trans_no,
            'trans_type'         =>$request->trans_type,
            'ref_no'             =>$request->ref_no,
            'description'        =>$request->description,
            'debit_amount'       =>$request->debit_amount,
            'credit_amount'      =>$request->credit_amount,
            'created_by'         =>$request->created_by,
            'void'               =>$request->void,
            'void_datetime'      =>$request->void_datetime,
      
       ]);
    
       return response()->json([
        'message'  => 'Company-Statement Created Successfully',
        'data'     =>   $companyStatement,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $companyStatement=Statement::find($id);
        return response()->json( $companyStatement);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validated = $request->validate([
            'invoice_no'                 =>'required|unique:statements,invoice_no|string|max:254',
            'folio_no'                   =>'required|unique:statements,folio_no',
            'company_id'                 =>'integer',
            'trans_date'                 =>'required|date_format:Y/m/d',
            'trans_no'                   =>'required|string',
            'trans_type'                 =>'required',
            'ref_no'                     =>'numeric|required',
            'description'                =>'required',
            'debit_amount'               =>'required',
            'credit_amount'              =>'required',
            'created_by'                 =>'integer',
            'void'                       =>'required',
            'void_datetime'              =>'required|date_format:Y/m/d',
            
            
        ]);

        $companyStatement = Statement::where('id',$id)->update([
            'invoice_no'         => $request-> invoice_no,
            'folio_no'           =>$request->folio_no,
            'company_id'         =>$request->company_id,
            'trans_date'         =>$request->trans_date,
            'trans_no'           =>$request->trans_no,
            'trans_type'         =>$request->trans_type,
            'ref_no'             =>$request->ref_no,
            'description'        =>$request->description,
            'debit_amount'       =>$request->debit_amount,
            'credit_amount'      =>$request->credit_amount,
            'created_by'         =>$request->created_by,
            'void'               =>$request->void,
            'void_datetime'      =>$request->void_datetime,
      
        ]);
        $companyStatement = Statement::where('id', $id)->get();

        return response([

            'message'  => 'Company-Statement Updated Successfully',
            'data' => $companyStatement], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $companyStatement=Statement ::where('id',$id)->delete();
        return response()->json([
            'status'     => true,
            'message'    => 'Company-Statement Deleted Successfully',
        ],201);
    }
}
