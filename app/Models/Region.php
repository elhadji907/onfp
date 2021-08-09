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
 * Class Region
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Departement[] $departements
 * @property Collection|Ecole[] $ecoles
 * @property Collection|Programme[] $programmes
 *
 * @package App\Models
 */
class Region extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'regions';

	protected $fillable = [
		'uuid',
		'nom'
	];

	public function demandeurs()
	{
		return $this->hasMany(Demandeur::class, 'regions_id');
	}

	public function departements()
	{
		return $this->hasMany(Departement::class, 'regions_id');
	}

	public function ecoles()
	{
		return $this->hasMany(Ecole::class, 'regions_id');
	}

	public function programmes()
	{
		return $this->belongsToMany(Programme::class, 'programmes_has_regions', 'regions_id', 'programmes_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
