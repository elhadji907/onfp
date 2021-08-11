<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
class User extends Authenticatable
{
    use HasFactory, Notifiable;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
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

	protected static function boot(){
		parent::boot();
		static::created(function ($user){
			$user->profile()->create([
				'titre'	=>	'',
				'description'	=>	'',
				'url'	=>	''
			]);
		});
	} 
	
	public function getRouteKeyName()
	{
		return 'username';
	}
	public function role()
	{
		return $this->belongsTo(Role::class, 'roles_id');
	}

	public function administrateur()
	{
		return $this->hasOne(Administrateur::class, 'users_id');
	}

	public function agent()
	{
		return $this->hasOne(Agent::class, 'users_id');
	}

	public function beneficiaire()
	{
		return $this->hasOne(Beneficiaire::class, 'users_id');
	}

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable')->latest();
	}

	public function comptable()
	{
		return $this->hasOne(Comptable::class, 'users_id');
	}

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'users_id');
	}

	public function demandeur()
	{
		return $this->hasOne(Demandeur::class, 'users_id');
	}

	public function employee()
	{
		return $this->hasOne(Employee::class, 'users_id');
	}

	public function gestionnaire()
	{
		return $this->hasOne(Gestionnaire::class, 'users_id');
	}

	public function operateur()
	{
		return $this->hasOne(Operateur::class, 'users_id');
	}

	public function poste()
	{
		return $this->hasOne(Poste::class, 'users_id');
	}

	public function profile()
	{
		return $this->hasOne(Profile::class, 'users_id');
	}

	public function imputations()
	{
		return $this->belongsToMany(Imputation::class, 'users_has_imputations', 'users_id', 'imputations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}	
	//gestion des roles
	public function hasRole($roleName)
	{
		return $this->role->name === $roleName;
	}	
	public function hasAnyRoles($roles)
	{
		return in_array($this->role->name, $roles);
	}	
	public function isAdmin(){
		return false;
	}
}
