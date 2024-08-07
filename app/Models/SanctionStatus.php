<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SanctionStatus
 * 
 * @property int $id
 * @property string|null $status
 * @property int|null $company_id
 * 
 * @property CompanyDetail|null $company_detail
 *
 * @package App\Models
 */
class SanctionStatus extends Model
{
	protected $table = 'sanction_status';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'status',
		'company_id'
	];

	public function company_detail()
	{
		return $this->belongsTo(CompanyDetail::class, 'company_id');
	}
}
