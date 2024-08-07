<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactForHelp
 * 
 * @property int $id
 * @property string|null $comment
 * @property string $email_id
 * @property string|null $mobile_number
 * @property string $name
 *
 * @package App\Models
 */
class ContactForHelp extends Model
{
	protected $table = 'contact_for_help';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'comment',
		'email_id',
		'mobile_number',
		'name'
	];
}
