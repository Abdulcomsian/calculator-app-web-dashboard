<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardOfDirector
 *
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $designation
 * @property string|null $image_url
 * @property string|null $name
 * @property int|null $company_id
 *
 * @property CompanyDetail|null $company_detail
 *
 * @package App\Models
 */
class BoardOfDirector extends Model
{
	protected $table = 'board_of_director';

	protected $casts = [
		'id' => 'int',
		'company_id' => 'int'
	];

	protected $dates = [
		'created_date',
		'last_modified_date'
	];

	protected $fillable = [
		'created_by',
		'created_date',
		'last_modified_by',
		'last_modified_date',
		'designation',
		'image_url',
		'name',
		'company_id'
	];

	public function company_detail()
	{
		return $this->belongsTo(CompanyDetail::class, 'company_id');
	}
}
