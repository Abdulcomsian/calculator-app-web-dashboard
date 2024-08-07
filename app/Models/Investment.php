<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Investment
 * 
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $name
 * @property float|null $value
 * @property int|null $year
 * @property int|null $company_accounting_id
 * 
 * @property CompanyAccounting|null $company_accounting
 *
 * @package App\Models
 */
class Investment extends Model
{
	protected $table = 'investment';
	
	protected $casts = [
		'id' => 'int',
		'value' => 'float',
		'year' => 'int',
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
		'name',
		'value',
		'year',
		'company_accounting_id'
	];

	public function company_accounting()
	{
		return $this->belongsTo(CompanyAccounting::class);
	}
}
