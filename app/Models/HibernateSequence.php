<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HibernateSequence
 * 
 * @property int|null $next_val
 *
 * @package App\Models
 */
class HibernateSequence extends Model
{
	protected $table = 'hibernate_sequence';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'next_val' => 'int'
	];

	protected $fillable = [
		'next_val'
	];
}
