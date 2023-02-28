<?php

namespace App\Models;

use App\Models\User;
use App\Models\companyProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statement extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $guarded=[];

    public function companyProfile()
    {
       return $this->hasOne(companyProfile::class,'id','company_id');

    }



    public function users()
    {
       return $this->hasMany(User::class,'id','created_by');
    } 

}
