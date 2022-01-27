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
 * Class Demandeur
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero
 * @property string|null $statut
 * @property string|null $items1
 * @property string|null $items2
 * @property Carbon|null $date1
 * @property string|null $file1
 * @property int $users_id
 * @property int|null $items_id
 * @property int|null $types_demandes_id
 * @property int|null $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Courrier|null $courrier
 * @property Item|null $item
 * @property TypesDemande|null $types_demande
 * @property User $user
 * @property Collection|Collective[] $collectives
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|Disponibilite[] $disponibilites
 * @property Collection|Formation[] $formations
 * @property Collection|Module[] $modules
 * @property Collection|Individuelle[] $individuelles
 * @property Collection|Pcharge[] $pcharges
 * @property Collection|Titre[] $titres
 *
 * @package App\Models
 */
class Demandeur extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'demandeurs';

	protected $casts = [
		'users_id' => 'int',
		'items_id' => 'int',
		'types_demandes_id' => 'int',
		'courriers_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'statut',
		'items1',
		'items2',
		'date1',
		'file1',
		'users_id',
		'items_id',
		'types_demandes_id',
		'courriers_id'
	];

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function item()
	{
		return $this->belongsTo(Item::class, 'items_id');
	}

	public function types_demande()
	{
		return $this->belongsTo(TypesDemande::class, 'types_demandes_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function collectives()
	{
		return $this->hasMany(Collective::class, 'demandeurs_id');
	}

	public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'demandeurs_id');
	}

	public function disponibilites()
	{
		return $this->belongsToMany(Disponibilite::class, 'demandeursdisponibilites', 'demandeurs_id', 'disponibilites_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function formations()
	{
		return $this->belongsToMany(Formation::class, 'demandeursformations', 'demandeurs_id', 'formations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'demandeursmodules', 'demandeurs_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'demandeurs_id');
	}

	public function pcharges()
	{
		return $this->hasMany(Pcharge::class, 'demandeurs_id');
	}

	public function titres()
	{
		return $this->hasMany(Titre::class, 'demandeurs_id');
	}
}
