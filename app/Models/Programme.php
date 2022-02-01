<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Programme
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $sigle
 * @property string|null $duree
 * @property int|null $effectif
 * @property int|null $ingenieurs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Ingenieur|null $ingenieur
 * @property Collection|Collective[] $collectives
 * @property Collection|Formation[] $formations
 * @property Collection|Individuelle[] $individuelles
 * @property Collection|Localite[] $localites
 * @property Collection|Module[] $modules
 * @property Collection|Region[] $regions
 *
 * @package App\Models
 */
class Programme extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'programmes';

	protected $casts = [
		'effectif' => 'int',
		'ingenieurs_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'duree',
		'effectif',
		'ingenieurs_id'
	];

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
	}

	public function collectives()
	{
		return $this->belongsToMany(Collective::class, 'collectivesprogrammes', 'programmes_id', 'collectives_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'programmes_id');
	}

	public function individuelles()
	{
		return $this->belongsToMany(Individuelle::class, 'individuellesprogrammes', 'programmes_id', 'individuelles_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function localites()
	{
		return $this->hasMany(Localite::class, 'programmes_id');
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'programmesmodules', 'programmes_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function regions()
	{
		return $this->belongsToMany(Region::class, 'programmesregions', 'programmes_id', 'regions_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
