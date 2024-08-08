<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'contact_no',
        'first_name',
        'last_name',
        'photo'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
