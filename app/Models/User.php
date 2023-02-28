<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Coderflex\LaravelTicket\Concerns\HasTickets;
use Coderflex\LaravelTicket\Contracts\CanUseTickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LucasDotVin\Soulbscription\Models\Concerns\HasSubscriptions;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
implements CanUseTickets
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasSubscriptions;
    use SoftDeletes;

    use LogsActivity;
    use HasTickets;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()

            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "User has been {$eventName}");
    }
    protected $dates = ['deleted_at'];
    protected static $logName = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phonenumber',
        'email',
        'password',
        'role',

    ];
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

/**
 * The attributes that should be hidden for serialization.
 *
 * @var array<int, string>
 */
    protected $hidden = [
        'password',
        'remember_token',
    ];

/**
 * The attributes that should be cast.
 *
 * @var array<string, string>
 */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
