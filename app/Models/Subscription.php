<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_name',
        'price',
        'status',
        'user_id',
        'package_id',
        'sanctions_balance',
    ];

    public function user(){
        $this->belongsTo(User::class,'user_id');
    }
}
