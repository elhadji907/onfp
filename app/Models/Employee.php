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
 * Class Employee
 * 
 * @property int $id
 * @property string $uuid
 * @property string $matricule
 * @property string|null $adresse
 * @property string $cin
 * @property Carbon|null $date_embauche
 * @property string|null $classification
 * @property string|null $categorie_salaire
 * @property int $users_id
 * @property int|null $categories_id
 * @property int|null $fonctions_id
 * @property int|null $directions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category|null $category
 * @property Direction|null $direction
 * @property Fonction|null $fonction
 * @property User $user
 * @property Collection|Charge[] $charges
 * @property Collection|Conger[] $congers
 * @property Collection|Dossier[] $dossiers
 * @property Collection|Courrier[] $courriers
 * @property Collection|Formation[] $formations
 * @property Collection|Imputation[] $imputations
 * @property Collection|Famille[] $familles
 * @property Collection|Mission[] $missions
 * @property Collection|OrdresMission[] $ordres_missions
 * @property Collection|Prestataire[] $prestataires
 * @property Collection|Salaire[] $salaires
 * @property Collection|Sorty[] $sorties
 * @property Collection|Stagiaire[] $stagiaires
 *
 * @package App\Models
 */
class Employee extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'employees';

	protected $casts = [
		'users_id' => 'int',
		'categories_id' => 'int',
		'fonctions_id' => 'int',
		'directions_id' => 'int'
	];

	protected $dates = [
		'date_embauche'
	];

	protected $fillable = [
		'uuid',
		'matricule',
		'adresse',
		'cin',
		'date_embauche',
		'classification',
		'categorie_salaire',
		'users_id',
		'categories_id',
		'fonctions_id',
		'directions_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'categories_id');
	}

	public function direction()
	{
		return $this->belongsTo(Direction::class, 'directions_id');
	}

	public function fonction()
	{
		return $this->belongsTo(Fonction::class, 'fonctions_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function charges()
	{
		return $this->hasMany(Charge::class, 'employees_id');
	}

	public function congers()
	{
		return $this->hasMany(Conger::class, 'employees_id');
	}

	public function dossiers()
	{
		return $this->hasMany(Dossier::class, 'employees_id');
	}

	public function courriers()
	{
		return $this->belongsToMany(Courrier::class, 'employees_has_courriers', 'employees_id', 'courriers_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function formations()
	{
		return $this->belongsToMany(Formation::class, 'employees_has_formations', 'employees_id', 'formations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function imputations()
	{
		return $this->belongsToMany(Imputation::class, 'employees_has_imputations', 'employees_id', 'imputations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function familles()
	{
		return $this->hasMany(Famille::class, 'employees_id');
	}

	public function missions()
	{
		return $this->hasMany(Mission::class, 'employees_id');
	}

	public function ordres_missions()
	{
		return $this->hasMany(OrdresMission::class, 'employees_id');
	}

	public function prestataires()
	{
		return $this->hasMany(Prestataire::class, 'employees_id');
	}

	public function salaires()
	{
		return $this->hasMany(Salaire::class, 'employees_id');
	}

	public function sorties()
	{
		return $this->hasMany(Sorty::class, 'employees_id');
	}

	public function stagiaires()
	{
		return $this->hasMany(Stagiaire::class, 'employees_id');
	}
}
