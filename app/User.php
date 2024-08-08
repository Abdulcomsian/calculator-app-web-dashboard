<?php

namespace App;

use App\Models\Contact;
use App\Models\Country;
use App\Models\Subscription;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'profile_picture',
        'remember_token',
        'password_reset_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function subscription(){
        return $this->hasOne(Subscription::class);
    }

    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
