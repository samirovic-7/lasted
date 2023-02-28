<?php

namespace App\Http\Controllers\Api\V1\Permission;

use App\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\PermissionRsource;

use function PHPUnit\Framework\isEmpty;

class PermissionController extends Controller
{
    use helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        if($permissions->first()){
            return $this->apiResponse(new GeneralCollection($permissions, PermissionRsource::class));

        }else{
            return['message' => __('not found')];
        }
    }

    public function getPermissionByID($id)
    {
      
        $permissions = Permission::where('id',$id)->get();
        if($permissions->first()){
        return $this->apiResponse(['data' => $permissions], 200);
       }else{
        return['message' => 'not found'];
       }
        
       
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:254',
        ]);
       
        $permission = Permission::create(['name' => $request->name]);

        return $this->apiResponse(['data' => $permission], 200);
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:254',
        ]);

        $permission = Permission::where('id',$request->id)->update([
            'name' => $request->name,
        ]);
        $permission = Permission::where('id', $request->id)->get();

        return $this->apiResponse(['data' => $permission], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       // dd('ss');
        $permission = Permission::where('id', $id)->delete();
        if($permission){
            return $this->apiResponse(['message' => 'The Permission Has Been Deleted'], 200);
        }else{
            return $this->apiResponse(['message' => 'not found'], 200);
        }
        
        

    }
}
