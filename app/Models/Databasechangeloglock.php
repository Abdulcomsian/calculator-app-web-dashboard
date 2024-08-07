<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Databasechangeloglock
 * 
 * @property int $ID
 * @property bool $LOCKED
 * @property Carbon|null $LOCKGRANTED
 * @property string|null $LOCKEDBY
 *
 * @package App\Models
 */
class Databasechangeloglock extends Model
{
	protected $table = 'databasechangeloglock';
	protected $primaryKey = 'ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int',
		'LOCKED' => 'bool'
	];

	protected $dates = [
		'LOCKGRANTED'
	];

	protected $fillable = [
		'LOCKED',
		'LOCKGRANTED',
		'LOCKEDBY'
	];
}
