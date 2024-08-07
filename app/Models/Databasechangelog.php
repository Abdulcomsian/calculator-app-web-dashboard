<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Databasechangelog
 * 
 * @property string $ID
 * @property string $AUTHOR
 * @property string $FILENAME
 * @property Carbon $DATEEXECUTED
 * @property int $ORDEREXECUTED
 * @property string $EXECTYPE
 * @property string|null $MD5SUM
 * @property string|null $DESCRIPTION
 * @property string|null $COMMENTS
 * @property string|null $TAG
 * @property string|null $LIQUIBASE
 * @property string|null $CONTEXTS
 * @property string|null $LABELS
 * @property string|null $DEPLOYMENT_ID
 *
 * @package App\Models
 */
class Databasechangelog extends Model
{
	protected $table = 'databasechangelog';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ORDEREXECUTED' => 'int'
	];

	protected $dates = [
		'DATEEXECUTED'
	];

	protected $fillable = [
		'ID',
		'AUTHOR',
		'FILENAME',
		'DATEEXECUTED',
		'ORDEREXECUTED',
		'EXECTYPE',
		'MD5SUM',
		'DESCRIPTION',
		'COMMENTS',
		'TAG',
		'LIQUIBASE',
		'CONTEXTS',
		'LABELS',
		'DEPLOYMENT_ID'
	];
}
