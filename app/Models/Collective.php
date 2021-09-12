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
 * Class Collective
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property Carbon|null $date_depot
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $statut
 * @property string|null $description
 * @property string|null $type
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $fixe
 * @property string|null $bp
 * @property string|null $fax
 * @property string|null $projetprofessionnel
 * @property string|null $experience
 * @property string|null $prerequis
 * @property string|null $motivation
 * @property int|null $nbre_pieces
 * @property int $demandeurs_id
 * @property int|null $ingenieurs_id
 * @property int|null $formations_id
 * @property int|null $communes_id
 * @property int|null $etudes_id
 * @property int|null $antennes_id
 * @property int|null $programmes_id
 * @property int|null $projets_id
 * @property string|null $file1
 * @property string|null $file2
 * @property string|null $file3
 * @property string|null $file4
 * @property string|null $file5
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Antenne|null $antenne
 * @property Commune|null $commune
 * @property Demandeur $demandeur
 * @property Etude|null $etude
 * @property Formation|null $formation
 * @property Ingenieur|null $ingenieur
 * @property Programme|null $programme
 * @property Projet|null $projet
 * @property Collection|Module[] $modules
 * @property Collection|Membre[] $membres
 *
 * @package App\Models
 */
class Collective extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'collectives';

	protected $casts = [
		'nbre_pieces' => 'int',
		'demandeurs_id' => 'int',
		'ingenieurs_id' => 'int',
		'formations_id' => 'int',
		'communes_id' => 'int',
		'etudes_id' => 'int',
		'antennes_id' => 'int',
		'programmes_id' => 'int',
		'projets_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'date_depot',
		'items1',
		'date1',
		'statut',
		'description',
		'type',
		'adresse',
		'telephone',
		'fixe',
		'bp',
		'fax',
		'projetprofessionnel',
		'experience',
		'prerequis',
		'motivation',
		'nbre_pieces',
		'demandeurs_id',
		'ingenieurs_id',
		'formations_id',
		'communes_id',
		'etudes_id',
		'antennes_id',
		'programmes_id',
		'projets_id',
		'file1',
		'file2',
		'file3',
		'file4',
		'file5'
	];

	public function antenne()
	{
		return $this->belongsTo(Antenne::class, 'antennes_id');
	}

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function etude()
	{
		return $this->belongsTo(Etude::class, 'etudes_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'collectivesmodules', 'collectives_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function membres()
	{
		return $this->hasMany(Membre::class, 'collectives_id');
	}
}
