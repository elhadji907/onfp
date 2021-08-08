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
 * Class Formation
 * 
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property string|null $name
 * @property string|null $qualifications
 * @property string|null $effectif_total
 * @property Carbon|null $date_pv
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property string|null $adresse
 * @property int|null $prevue_h
 * @property int|null $prevue_f
 * @property string|null $type
 * @property string|null $titre
 * @property string|null $attestation
 * @property int|null $forme_h
 * @property int|null $forme_f
 * @property int|null $total
 * @property string|null $lieu
 * @property string|null $convention_col
 * @property string|null $decret
 * @property string|null $beneficiaires
 * @property int|null $ingenieurs_id
 * @property int|null $factures_id
 * @property int|null $agents_id
 * @property int|null $detfs_id
 * @property int|null $conventions_id
 * @property int|null $programmes_id
 * @property int|null $operateurs_id
 * @property int|null $traitements_id
 * @property int|null $niveauxs_id
 * @property int|null $specialites_id
 * @property int|null $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Agent|null $agent
 * @property Facture|null $facture
 * @property Convention|null $convention
 * @property Courrier|null $courrier
 * @property Detf|null $detf
 * @property Ingenieur|null $ingenieur
 * @property Niveaux|null $niveaux
 * @property Operateur|null $operateur
 * @property Programme|null $programme
 * @property Specialite|null $specialite
 * @property Traitement|null $traitement
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Detail[] $details
 * @property Collection|Employee[] $employees
 * @property Collection|Evaluation[] $evaluations
 *
 * @package App\Models
 */
class Formation extends Model
{
	use SoftDeletes;
	protected $table = 'formations';

	protected $casts = [
		'prevue_h' => 'int',
		'prevue_f' => 'int',
		'forme_h' => 'int',
		'forme_f' => 'int',
		'total' => 'int',
		'ingenieurs_id' => 'int',
		'factures_id' => 'int',
		'agents_id' => 'int',
		'detfs_id' => 'int',
		'conventions_id' => 'int',
		'programmes_id' => 'int',
		'operateurs_id' => 'int',
		'traitements_id' => 'int',
		'niveauxs_id' => 'int',
		'specialites_id' => 'int',
		'courriers_id' => 'int'
	];

	protected $dates = [
		'date_pv',
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'uuid',
		'code',
		'name',
		'qualifications',
		'effectif_total',
		'date_pv',
		'date_debut',
		'date_fin',
		'adresse',
		'prevue_h',
		'prevue_f',
		'type',
		'titre',
		'attestation',
		'forme_h',
		'forme_f',
		'total',
		'lieu',
		'convention_col',
		'decret',
		'beneficiaires',
		'ingenieurs_id',
		'factures_id',
		'agents_id',
		'detfs_id',
		'conventions_id',
		'programmes_id',
		'operateurs_id',
		'traitements_id',
		'niveauxs_id',
		'specialites_id',
		'courriers_id'
	];

	public function agent()
	{
		return $this->belongsTo(Agent::class, 'agents_id');
	}

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'factures_id');
	}

	public function convention()
	{
		return $this->belongsTo(Convention::class, 'conventions_id');
	}

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function detf()
	{
		return $this->belongsTo(Detf::class, 'detfs_id');
	}

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
	}

	public function niveaux()
	{
		return $this->belongsTo(Niveaux::class, 'niveauxs_id');
	}

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function traitement()
	{
		return $this->belongsTo(Traitement::class, 'traitements_id');
	}

	public function beneficiaires()
	{
		return $this->belongsToMany(Beneficiaire::class, 'beneficiaires_has_formations', 'formations_id', 'beneficiaires_id')
					->withPivot('deleted_at')
					->withTimestamps();
	}

	public function demandeurs()
	{
		return $this->belongsToMany(Demandeur::class, 'demandeurs_has_formations', 'formations_id', 'demandeurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function details()
	{
		return $this->hasMany(Detail::class, 'formations_id');
	}

	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employees_has_formations', 'formations_id', 'employees_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function evaluations()
	{
		return $this->belongsToMany(Evaluation::class, 'formations_has_evaluations', 'formations_id', 'evaluations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
