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
 * Class User
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $civilite
 * @property string|null $firstname
 * @property string|null $name
 * @property string|null $username
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $fixe
 * @property string|null $sexe
 * @property Carbon|null $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $situation_familiale
 * @property string|null $adresse
 * @property string|null $bp
 * @property string|null $fax
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property int $roles_id
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property Collection|Administrateur[] $administrateurs
 * @property Collection|Agent[] $agents
 * @property Collection|Beneficiaire[] $beneficiaires
 * @property Collection|Comment[] $comments
 * @property Collection|Comptable[] $comptables
 * @property Collection|Courrier[] $courriers
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Employee[] $employees
 * @property Collection|Gestionnaire[] $gestionnaires
 * @property Collection|Operateur[] $operateurs
 * @property Collection|Poste[] $postes
 * @property Collection|Profile[] $profiles
 * @property Collection|Imputation[] $imputations
 *
 * @package App\Models
 */
class User extends Model
{
	use SoftDeletes;
	protected $table = 'users';

	protected $casts = [
		'roles_id' => 'int'
	];

	protected $dates = [
		'date_naissance',
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'uuid',
		'civilite',
		'firstname',
		'name',
		'username',
		'email',
		'telephone',
		'fixe',
		'sexe',
		'date_naissance',
		'lieu_naissance',
		'situation_familiale',
		'adresse',
		'bp',
		'fax',
		'email_verified_at',
		'password',
		'created_by',
		'updated_by',
		'deleted_by',
		'roles_id',
		'remember_token'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'roles_id');
	}

	public function administrateurs()
	{
		return $this->hasMany(Administrateur::class, 'users_id');
	}

	public function agents()
	{
		return $this->hasMany(Agent::class, 'users_id');
	}

	public function beneficiaires()
	{
		return $this->hasMany(Beneficiaire::class, 'users_id');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class, 'users_id');
	}

	public function comptables()
	{
		return $this->hasMany(Comptable::class, 'users_id');
	}

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'users_id');
	}

	public function demandeurs()
	{
		return $this->hasMany(Demandeur::class, 'users_id');
	}

	public function employees()
	{
		return $this->hasMany(Employee::class, 'users_id');
	}

	public function gestionnaires()
	{
		return $this->hasMany(Gestionnaire::class, 'users_id');
	}

	public function operateurs()
	{
		return $this->hasMany(Operateur::class, 'users_id');
	}

	public function postes()
	{
		return $this->hasMany(Poste::class, 'users_id');
	}

	public function profiles()
	{
		return $this->hasMany(Profile::class, 'users_id');
	}

	public function imputations()
	{
		return $this->belongsToMany(Imputation::class, 'users_has_imputations', 'users_id', 'imputations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
