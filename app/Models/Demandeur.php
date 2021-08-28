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
 * @property string|null $etablissement
 * @property string|null $niveau_etude
 * @property string|null $qualification
 * @property string|null $experience
 * @property string|null $deja_forme
 * @property string|null $adresse
 * @property string|null $pre_requis
 * @property string|null $option
 * @property string|null $autres_diplomes
 * @property string|null $telephone
 * @property string|null $fixe
 * @property int|null $nbre_piece
 * @property string|null $statut
 * @property string|null $motivation
 * @property string|null $items1
 * @property string|null $items2
 * @property Carbon|null $date_depot
 * @property string|null $motif
 * @property Carbon|null $date1
 * @property Carbon|null $date2
 * @property string|null $file1
 * @property string|null $file2
 * @property string|null $file3
 * @property string|null $file4
 * @property string|null $file5
 * @property string|null $file6
 * @property string|null $file7
 * @property string|null $file8
 * @property string|null $file9
 * @property string|null $file10
 * @property int $users_id
 * @property int|null $lieux_id
 * @property int|null $items_id
 * @property int|null $projets_id
 * @property int|null $programmes_id
 * @property int|null $regions_id
 * @property int|null $diplomes_id
 * @property int|null $types_demandes_id
 * @property int|null $courriers_id
 * @property int|null $communes_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune|null $commune
 * @property Courrier|null $courrier
 * @property Diplome|null $diplome
 * @property Item|null $item
 * @property Lieux|null $lieux
 * @property Programme|null $programme
 * @property Projet|null $projet
 * @property Region|null $region
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
		'nbre_piece' => 'int',
		'users_id' => 'int',
		'lieux_id' => 'int',
		'items_id' => 'int',
		'projets_id' => 'int',
		'programmes_id' => 'int',
		'regions_id' => 'int',
		'diplomes_id' => 'int',
		'types_demandes_id' => 'int',
		'courriers_id' => 'int',
		'communes_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'date1',
		'date2'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'etablissement',
		'niveau_etude',
		'qualification',
		'experience',
		'deja_forme',
		'adresse',
		'pre_requis',
		'option',
		'autres_diplomes',
		'telephone',
		'fixe',
		'nbre_piece',
		'statut',
		'motivation',
		'items1',
		'items2',
		'date_depot',
		'motif',
		'date1',
		'date2',
		'file1',
		'file2',
		'file3',
		'file4',
		'file5',
		'file6',
		'file7',
		'file8',
		'file9',
		'file10',
		'users_id',
		'lieux_id',
		'items_id',
		'projets_id',
		'programmes_id',
		'regions_id',
		'diplomes_id',
		'types_demandes_id',
		'courriers_id',
		'communes_id'
	];

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function diplome()
	{
		return $this->belongsTo(Diplome::class, 'diplomes_id');
	}

	public function item()
	{
		return $this->belongsTo(Item::class, 'items_id');
	}

	public function lieux()
	{
		return $this->belongsTo(Lieux::class);
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
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
