<?php

namespace App\Models;

use App\Models\PaymentMode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment_type extends Model
{
     use SoftDeletes;
    use HasFactory;
    protected $table = 'payment_types';
    protected $guarded=[];

     public function modes()
     {
        return $this->hasOne(PaymentMode::class,'payment_modes_id');
    }
}
