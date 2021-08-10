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
 * Class Operateur
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero_agrement
 * @property string|null $name
 * @property string|null $sigle
 * @property string|null $type_structure
 * @property string|null $ninea
 * @property string|null $rccm
 * @property string|null $quitus
 * @property string|null $telephone1
 * @property string|null $telephone2
 * @property string|null $fixe
 * @property string|null $email1
 * @property string|null $email2
 * @property string|null $adresse
 * @property int|null $communes_id
 * @property int|null $users_id
 * @property int|null $rccms_id
 * @property int|null $nineas_id
 * @property int|null $types_operateurs_id
 * @property int|null $quitus_id
 * @property int|null $responsables_id
 * @property int|null $specialites_id
 * @property int|null $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune|null $commune
 * @property Courrier|null $courrier
 * @property Quitu|null $quitu
 * @property Responsable|null $responsable
 * @property Specialite|null $specialite
 * @property TypesOperateur|null $types_operateur
 * @property User|null $user
 * @property Collection|Agrement[] $agrements
 * @property Collection|Formation[] $formations
 * @property Collection|Module[] $modules
 * @property Collection|Niveaux[] $niveauxes
 * @property Collection|Traitement[] $traitements
 *
 * @package App\Models
 */
class Operateur extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'operateurs';

	protected $casts = [
		'communes_id' => 'int',
		'users_id' => 'int',
		'rccms_id' => 'int',
		'nineas_id' => 'int',
		'types_operateurs_id' => 'int',
		'quitus_id' => 'int',
		'responsables_id' => 'int',
		'specialites_id' => 'int',
		'courriers_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'numero_agrement',
		'name',
		'sigle',
		'type_structure',
		'ninea',
		'rccm',
		'quitus',
		'telephone1',
		'telephone2',
		'fixe',
		'email1',
		'email2',
		'adresse',
		'communes_id',
		'users_id',
		'rccms_id',
		'nineas_id',
		'types_operateurs_id',
		'quitus_id',
		'responsables_id',
		'specialites_id',
		'courriers_id'
	];

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function ninea()
	{
		return $this->belongsTo(Ninea::class, 'nineas_id');
	}

	public function quitu()
	{
		return $this->belongsTo(Quitu::class, 'quitus_id');
	}

	public function rccm()
	{
		return $this->belongsTo(Rccm::class, 'rccms_id');
	}

	public function responsable()
	{
		return $this->belongsTo(Responsable::class, 'responsables_id');
	}

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function types_operateur()
	{
		return $this->belongsTo(TypesOperateur::class, 'types_operateurs_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function agrements()
	{
		return $this->hasMany(Agrement::class, 'operateurs_id');
	}

	public function formations()
	{
		return $this->hasMany(Formation::class, 'operateurs_id');
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'modules_has_operateurs', 'operateurs_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function niveauxes()
	{
		return $this->belongsToMany(Niveaux::class, 'operateurs_has_niveaux', 'operateurs_id')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function traitements()
	{
		return $this->hasMany(Traitement::class, 'operateurs_id');
	}
}
