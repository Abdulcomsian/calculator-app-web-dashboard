<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarketShare
 * 
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property float|null $authorized_shares
 * @property float|null $issued_shares
 * @property float|null $no_of_shares
 * @property string|null $paid_up_shares
 * @property float|null $total_share
 * @property int|null $company_id
 * 
 * @property CompanyDetail|null $company_detail
 * @property Collection|Shareholder[] $shareholders
 *
 * @package App\Models
 */
class MarketShare extends Model
{
	protected $table = 'market_share';
	protected $casts = [
		'id' => 'int',
		'authorized_shares' => 'float',
		'issued_shares' => 'float',
		'no_of_shares' => 'float',
		'total_share' => 'float',
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
		'authorized_shares',
		'issued_shares',
		'no_of_shares',
		'paid_up_shares',
		'total_share',
		'company_id'
	];

	public function company_detail()
	{
		return $this->belongsTo(CompanyDetail::class, 'company_id');
	}

	public function shareholders()
	{
		return $this->hasMany(Shareholder::class);
	}
}
