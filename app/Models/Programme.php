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
 * Class Programme
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $sigle
 * @property string|null $duree
 * @property int|null $effectif
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Formation[] $formations
 * @property Collection|Module[] $modules
 * @property Collection|Region[] $regions
 *
 * @package App\Models
 */
class Programme extends Model
{
	use SoftDeletes;
	protected $table = 'programmes';

	protected $casts = [
		'effectif' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'duree',
		'effectif'
	];

	public function demandeurs()
	{
		return $this->hasMany(Demandeur::class, 'programmes_id');
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'programmes_id');
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'programmes_has_modules', 'programmes_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function regions()
	{
		return $this->belongsToMany(Region::class, 'programmes_has_regions', 'programmes_id', 'regions_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
