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
 * Class Module
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property int|null $domaines_id
 * @property int|null $specialites_id
 * @property string|null $qualification
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Domaine|null $domaine
 * @property Specialite|null $specialite
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Evaluateur[] $evaluateurs
 * @property Collection|Niveaux[] $niveauxes
 * @property Collection|Operateur[] $operateurs
 * @property Collection|Programme[] $programmes
 *
 * @package App\Models
 */
class Module extends Model
{
	use SoftDeletes;
	protected $table = 'modules';

	protected $casts = [
		'domaines_id' => 'int',
		'specialites_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'domaines_id',
		'specialites_id',
		'qualification'
	];

	public function domaine()
	{
		return $this->belongsTo(Domaine::class, 'domaines_id');
	}

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function demandeurs()
	{
		return $this->belongsToMany(Demandeur::class, 'demandeurs_has_modules', 'modules_id', 'demandeurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function evaluateurs()
	{
		return $this->belongsToMany(Evaluateur::class, 'evaluateurs_has_modules', 'modules_id', 'evaluateurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function niveauxes()
	{
		return $this->belongsToMany(Niveaux::class, 'modules_has_niveauxs', 'modules_id', 'niveauxs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function operateurs()
	{
		return $this->belongsToMany(Operateur::class, 'modules_has_operateurs', 'modules_id', 'operateurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function programmes()
	{
		return $this->belongsToMany(Programme::class, 'programmes_has_modules', 'modules_id', 'programmes_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
