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
 * Class Antenne
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property int|null $regions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Region|null $region
 * @property Collection|Collective[] $collectives
 * @property Collection|Individuelle[] $individuelles
 *
 * @package App\Models
 */
class Antenne extends Model
{
	use SoftDeletes;
	protected $table = 'antennes';

	protected $casts = [
		'regions_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'regions_id'
	];

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}

	public function collectives()
	{
		return $this->hasMany(Collective::class, 'antennes_id');
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'antennes_id');
	}
}
