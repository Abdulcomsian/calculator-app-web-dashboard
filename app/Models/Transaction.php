<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @property string $cart_id
 * @property int|null $order_id
 * @property int $store_id
 * @property bool $test_mode
 * @property float $amount
 * @property string $description
 * @property string $success_url
 * @property string $canceled_url
 * @property string $declined_url
 * @property string|null $billing_fname
 * @property string|null $billing_sname
 * @property string|null $billing_address_1
 * @property string|null $billing_address_2
 * @property string|null $billing_city
 * @property string|null $billing_region
 * @property string|null $billing_zip
 * @property string|null $billing_country
 * @property string|null $billing_email
 * @property string|null $lang_code
 * @property string|null $trx_reference
 * @property bool|null $approved
 * @property string|null $response
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transaction';
	protected $primaryKey = 'cart_id';
//	public $incrementing = false;

	protected $casts = [
		'order_id' => 'int',
		'store_id' => 'int',
		'test_mode' => 'bool',
		'amount' => 'float',
		'approved' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'order_id',
		'cart_id',
		'store_id',
		'test_mode',
		'amount',
		'description',
		'success_url',
		'canceled_url',
		'declined_url',
		'billing_fname',
		'billing_sname',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_region',
		'billing_zip',
		'billing_country',
		'billing_email',
		'lang_code',
		'trx_reference',
		'approved',
		'response',
		'status'
	];
}
