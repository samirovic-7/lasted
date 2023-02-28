<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['file','ticket_id'];
    
    protected $dates = ['deleted_at'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
