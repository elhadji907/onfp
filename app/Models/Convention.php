<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Convention
 * 
 * @property int $id
 * @property string $uuid
 * @property string $numero
 * @property string|null $name
 * @property Carbon|null $date
 * @property string|null $items1
 * @property string|null $items2
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Formation[] $formations
 *
 * @package App\Models
 */
class Convention extends Model
{
	use SoftDeletes;
	protected $table = 'conventions';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'name',
		'date',
		'items1',
		'items2'
	];

	public function formations()
	{
		return $this->hasMany(Formation::class, 'conventions_id');
	}
}
