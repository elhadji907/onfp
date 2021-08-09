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
 * Class Responsable
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $cin
 * @property string $prenom
 * @property string|null $nom
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $adresse
 * @property string|null $fonction
 * @property Carbon|null $date
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Agrement[] $agrements
 * @property Collection|Operateur[] $operateurs
 *
 * @package App\Models
 */
class Responsable extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'responsables';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'cin',
		'prenom',
		'nom',
		'email',
		'telephone',
		'adresse',
		'fonction',
		'date'
	];

	public function agrements()
	{
		return $this->hasMany(Agrement::class, 'responsables_id');
	}

	public function operateurs()
	{
		return $this->hasMany(Operateur::class, 'responsables_id');
	}
}
