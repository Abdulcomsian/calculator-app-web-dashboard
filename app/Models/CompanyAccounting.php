<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyAccounting
 * 
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $currency
 * @property string|null $financial_strength_rating
 * @property string|null $gross_written_premium
 * @property string|null $gross_written_premium_year
 * @property string|null $issue_credit_rating
 * @property string|null $moody_rating
 * @property string|null $other_rating
 * @property string|null $public_listed_company
 * @property string|null $regulatory_authority
 * @property string|null $s_andprating
 * @property int|null $company_id
 * 
 * @property CompanyDetail|null $company_detail
 * @property Collection|BalanceSheet[] $balance_sheets
 * @property Collection|IncomeStatement[] $income_statements
 * @property Collection|Investment[] $investments
 * @property Collection|Subsidiary[] $subsidiaries
 *
 * @package App\Models
 */
class CompanyAccounting extends Model
{
	protected $table = 'company_accounting';

	protected $dates = [
		'created_date',
		'last_modified_date'
	];

	protected $fillable = [
		'created_by',
		'created_date',
		'last_modified_by',
		'last_modified_date',
		'currency',
		'financial_strength_rating',
		'gross_written_premium',
		'gross_written_premium_year',
		'issue_credit_rating',
		'moody_rating',
		'other_rating',
		'public_listed_company',
		'regulatory_authority',
		's_andprating',
		'company_id'
	];

	public function company_detail()
	{
		return $this->belongsTo(CompanyDetail::class, 'company_id');
	}

	public function balance_sheets()
	{
		return $this->hasMany(BalanceSheet::class);
	}

	public function income_statements()
	{
		return $this->hasMany(IncomeStatement::class);
	}

	public function investments()
	{
		return $this->hasMany(Investment::class);
	}

	public function subsidiaries()
	{
		return $this->hasMany(Subsidiary::class);
	}
}
