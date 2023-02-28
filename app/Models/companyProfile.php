<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class companyProfile extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];


    public function profiles()
     {
        return $this->hasOne(Country::class,'country_id');
    }
}
