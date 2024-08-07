<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyDetail
 *
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $about
 * @property string|null $auditor
 * @property string|null $company_email_id
 * @property string|null $company_name
 * @property string|null $company_type
 * @property string|null $company_website
 * @property string|null $contact_number
 * @property string|null $corporate_details
 * @property string|null $country
 * @property int $employee_count
 * @property string|null $fax_detail
 * @property boolean|null $financial_report
 * @property string|null $image_url
 * @property string|null $incorporated
 * @property string|null $incorporated_year
 * @property string|null $location
 * @property string|null $toll_free_number
 * @property string|null $trade_name
 * @property string|null $alternative_names
 *
 * @property Collection|BoardOfDirector[] $board_of_directors
 * @property Collection|CompanyAccounting[] $company_accountings
 * @property Collection|MarketShare[] $market_shares
 * @property Collection|SanctionStatus[] $sanction_statuses
 *
 * @package App\Models
 */
class CompanyDetail extends Model
{
	protected $table = 'company_detail';
	protected $dates = [
		'created_date',
		'last_modified_date'
	];
	protected $fillable = [
		'created_by',
		'created_date',
		'last_modified_by',
		'last_modified_date',
		'about',
		'auditor',
		'company_email_id',
		'company_name',
		'company_type',
		'company_website',
		'contact_number',
		'corporate_details',
		'country',
		'employee_count',
		'fax_detail',
		'financial_report',
		'image_url',
		'incorporated',
		'incorporated_year',
		'location',
		'toll_free_number',
		'trade_name',
		'alternative_names',
        'status',
	];

	public function board_of_directors()
	{
		return $this->hasMany(BoardOfDirector::class, 'company_id');
	}

	public function company_accounting()
	{
		return $this->hasOne(CompanyAccounting::class, 'company_id');
	}

	public function market_share()
	{
		return $this->hasOne(MarketShare::class, 'company_id');
	}

	public function sanction_statuses()
	{
		return $this->hasMany(SanctionStatus::class, 'company_id');
	}
}
