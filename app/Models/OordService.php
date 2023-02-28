<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OordService extends Model
{
    use HasFactory , SoftDeletes;

    protected  $fillable=[
        'room_id',
       // 'oord_typ',        //(will be OO, OS)
        'start_date',
        'end_date',
        'notes',
        'created_by',       //(user_id)
        'is_return',       //(boolean) default 0
        'return_by' ,      //(user_id)
        'return_date',
    ];

    public function users()
    {
       return $this->hasMany(User::class,'id','created_by');
    } 

    public function user()
    {
       return $this->hasMany(User::class,'id','return_by');
    } 

    public function room()
    {
       return $this->hasOne(Room::class,'id','room_id');
    } 
}
