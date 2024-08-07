<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shareholder
 *
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $name
 * @property float|null $share_percentage
 * @property int|null $market_share_id
 *
 * @property MarketShare|null $market_share
 *
 * @package App\Models
 */
class Shareholder extends Model
{
	protected $table = 'shareholder';
	protected $casts = [
		'id' => 'int',
		'share_percentage' => 'float',
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
		'share_percentage',
		'market_share_id'
	];

	public function market_share()
	{
		return $this->belongsTo(MarketShare::class);
	}
}
