<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Notification
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $type
 * @property int|null $notifiable
 * @property string|null $data
 * @property Carbon|null $read_at
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Notification extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'notifications';

	protected $casts = [
		'notifiable' => 'int'
	];

	protected $dates = [
		'read_at'
	];

	protected $fillable = [
		'uuid',
		'type',
		'notifiable',
		'data',
		'read_at'
	];
}
