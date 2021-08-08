<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ecole
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $sigle
 * @property string|null $telephone1
 * @property string|null $telephone2
 * @property string|null $fixe
 * @property string|null $email
 * @property string|null $adresse
 * @property int|null $regions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Region|null $region
 *
 * @package App\Models
 */
class Ecole extends Model
{
	use SoftDeletes;
	protected $table = 'ecoles';

	protected $casts = [
		'regions_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'items1',
		'date1',
		'sigle',
		'telephone1',
		'telephone2',
		'fixe',
		'email',
		'adresse',
		'regions_id'
	];

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}
}
