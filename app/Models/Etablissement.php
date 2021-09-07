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
 * Class Etablissement
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $matricule
 * @property string $name
 * @property string|null $sigle
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $telephone1
 * @property string|null $telephone2
 * @property string|null $fixe
 * @property string|null $email
 * @property string|null $adresse
 * @property int|null $communes_id
 * @property int|null $filieres_id
 * @property int|null $users_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune|null $commune
 * @property Filiere|null $filiere
 * @property User|null $user
 * @property Collection|Pcharge[] $pcharges
 *
 * @package App\Models
 */
class Etablissement extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'etablissements';

	protected $casts = [
		'communes_id' => 'int',
		'filieres_id' => 'int',
		'users_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'matricule',
		'name',
		'sigle',
		'items1',
		'date1',
		'telephone1',
		'telephone2',
		'fixe',
		'email',
		'adresse',
		'communes_id',
		'filieres_id',
		'users_id'
	];

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'filieres_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function pcharges()
	{
		return $this->hasMany(Pcharge::class, 'etablissements_id');
	}
}
