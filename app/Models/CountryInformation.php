<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryInformation
 *
 * @property int $id
 * @property string $created_by
 * @property Carbon|null $created_date
 * @property string|null $last_modified_by
 * @property Carbon|null $last_modified_date
 * @property string|null $country_name
 * @property boolean|null $law_governing_ins
 * @property string|null $no_of_operating_entities
 * @property string|null $reg_authority
 * @property string|null $reg_authority_web_link
 * @property string|null $latitude
 * @property string|null $longitude
 *
 * @package App\Models
 */
class CountryInformation extends Model
{
	protected $table = 'country_information';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'law_governing_ins' => 'boolean'
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
		'country_name',
		'law_governing_ins',
		'no_of_operating_entities',
		'reg_authority',
		'reg_authority_web_link',
		'latitude',
		'longitude',
        'rate_in_dollar'
	];
}
