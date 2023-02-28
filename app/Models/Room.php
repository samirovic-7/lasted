<?php

namespace App\Models;

use App\Models\Floor;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Room extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "Floor has been {$eventName}");
    }
    protected $fillable = [
        'room_no',
        'rm_name_en',
        'rm_name_loc',
        'rm_max_pax',
        'rm_phone_no',
        'rm_phone_ext',
        'rm_key_code',
        'rm_key_options',
        'rm_connection',
        'fo_status',
        'hk_stauts',
        'rm_active',
        'sort_order',
        'room_type_id',
        'floor_id',
    ];

    public function room_tybe()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type_id');
    }
    public function floors()
    {
        return $this->hasOne(Floor::class,'id','floor_id');
    }
}
