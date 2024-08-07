<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subsidiary
 * 
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $designation
 * @property string|null $image_url
 * @property string|null $name
 * @property int|null $company_accounting_id
 * 
 * @property CompanyAccounting|null $company_accounting
 *
 * @package App\Models
 */
class Subsidiary extends Model
{
	protected $table = 'subsidiary';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'company_accounting_id' => 'int'
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
		'company_accounting_id'
	];

	public function company_accounting()
	{
		return $this->belongsTo(CompanyAccounting::class);
	}
}
