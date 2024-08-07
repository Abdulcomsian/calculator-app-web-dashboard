<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $country_name
 * @property int $PhoneCode
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $casts = [
		'PhoneCode' => 'int'
	];

	protected $fillable = [
		'country_name',
		'PhoneCode'
	];
}
