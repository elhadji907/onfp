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
 * Class Individuelle
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero_dossier
 * @property string|null $cin
 * @property string|null $legende
 * @property string|null $reference
 * @property string|null $experience
 * @property string|null $projetprofessionnel
 * @property string|null $prerequis
 * @property string|null $information
 * @property Carbon|null $date_depot
 * @property float|null $note
 * @property string|null $statut
 * @property string|null $type
 * @property string|null $qualification
 * @property string|null $etablissement
 * @property string|null $adresse
 * @property string|null $option
 * @property string|null $autres_diplomes
 * @property string|null $autres_diplomes_pros
 * @property string|null $telephone
 * @property string|null $fixe
 * @property string|null $motivation
 * @property string|null $motif
 * @property int|null $annee_diplome
 * @property int|null $annee_diplome_professionelle
 * @property string|null $activite_travail
 * @property string|null $travail_renumeration
 * @property string|null $activite_avenir
 * @property string|null $handicap
 * @property string|null $situation_economique
 * @property string|null $victime_social
 * @property string|null $autre_victime
 * @property string|null $salaire
 * @property string|null $preciser_handicap
 * @property string|null $optiondiplome
 * @property string|null $items1
 * @property string|null $dossier
 * @property string|null $autre_diplomes_fournis
 * @property Carbon|null $date1
 * @property string|null $item1
 * @property string|null $item2
 * @property string|null $file1
 * @property string|null $file2
 * @property string|null $file3
 * @property string|null $file4
 * @property string|null $file5
 * @property string|null $file6
 * @property string|null $file7
 * @property int|null $nbre_pieces
 * @property int|null $nbre_enfants
 * @property int $demandeurs_id
 * @property int|null $formations_id
 * @property int|null $communes_id
 * @property int|null $etudes_id
 * @property int|null $antennes_id
 * @property int|null $programmes_id
 * @property int|null $diplomes_id
 * @property int|null $conventions_id
 * @property int|null $diplomespros_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Antenne|null $antenne
 * @property Commune|null $commune
 * @property Convention|null $convention
 * @property Demandeur $demandeur
 * @property Diplome|null $diplome
 * @property Diplomespro|null $diplomespro
 * @property Etude|null $etude
 * @property Formation|null $formation
 * @property Programme|null $programme
 * @property Collection|Localite[] $localites
 * @property Collection|Module[] $modules
 * @property Collection|Programme[] $programmes
 * @property Collection|Projet[] $projets
 * @property Collection|Zone[] $zones
 *
 * @package App\Models
 */
class Individuelle extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuelles';

	protected $casts = [
		'note' => 'float',
		'annee_diplome' => 'int',
		'annee_diplome_professionelle' => 'int',
		'nbre_pieces' => 'int',
		'nbre_enfants' => 'int',
		'demandeurs_id' => 'int',
		'formations_id' => 'int',
		'communes_id' => 'int',
		'etudes_id' => 'int',
		'antennes_id' => 'int',
		'programmes_id' => 'int',
		'diplomes_id' => 'int',
		'conventions_id' => 'int',
		'diplomespros_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'date1'
	];

	protected $fillable = [
		'uuid',
		'numero_dossier',
		'cin',
		'legende',
		'reference',
		'experience',
		'projetprofessionnel',
		'prerequis',
		'information',
		'date_depot',
		'note',
		'statut',
		'type',
		'qualification',
		'etablissement',
		'adresse',
		'option',
		'autres_diplomes',
		'autres_diplomes_pros',
		'telephone',
		'fixe',
		'motivation',
		'motif',
		'annee_diplome',
		'annee_diplome_professionelle',
		'activite_travail',
		'travail_renumeration',
		'activite_avenir',
		'handicap',
		'situation_economique',
		'victime_social',
		'autre_victime',
		'salaire',
		'preciser_handicap',
		'optiondiplome',
		'items1',
		'dossier',
		'autre_diplomes_fournis',
		'date1',
		'item1',
		'item2',
		'file1',
		'file2',
		'file3',
		'file4',
		'file5',
		'file6',
		'file7',
		'nbre_pieces',
		'nbre_enfants',
		'demandeurs_id',
		'formations_id',
		'communes_id',
		'etudes_id',
		'antennes_id',
		'programmes_id',
		'diplomes_id',
		'conventions_id',
		'diplomespros_id'
	];

	public function antenne()
	{
		return $this->belongsTo(Antenne::class, 'antennes_id');
	}

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function convention()
	{
		return $this->belongsTo(Convention::class, 'conventions_id');
	}

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function diplome()
	{
		return $this->belongsTo(Diplome::class, 'diplomes_id');
	}

	public function diplomespro()
	{
		return $this->belongsTo(Diplomespro::class, 'diplomespros_id');
	}

	public function etude()
	{
		return $this->belongsTo(Etude::class, 'etudes_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function localites()
	{
		return $this->belongsToMany(Localite::class, 'individuelleslocalites', 'individuelles_id', 'localites_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'individuellesmodules', 'individuelles_id', 'modules_id')
					->withPivot('id', 'individuellemodulestatut_id', 'deleted_at')
					->withTimestamps();
	}

	public function programmes()
	{
		return $this->belongsToMany(Programme::class, 'individuellesprogrammes', 'individuelles_id', 'programmes_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function projets()
	{
		return $this->belongsToMany(Projet::class, 'individuellesprojets', 'individuelles_id', 'projets_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function zones()
	{
		return $this->belongsToMany(Zone::class, 'individuelleszones', 'individuelles_id', 'zones_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
