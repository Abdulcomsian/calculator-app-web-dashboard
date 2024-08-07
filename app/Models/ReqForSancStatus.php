<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReqForSancStatus
 * 
 * @property int $id
 * @property string|null $comment
 * @property int $company_id
 * @property string $email_id
 * @property string $mobile_number
 * @property string|null $reason
 * @property int|null $user_id
 * @property string $name
 *
 * @package App\Models
 */
class ReqForSancStatus extends Model
{
	protected $table = 'req_for_sanc_status';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'company_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'comment',
		'company_id',
		'email_id',
		'mobile_number',
		'reason',
		'user_id',
		'name'
	];
}
