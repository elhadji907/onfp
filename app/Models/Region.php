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
 * @property Collection|Operateur[] $operateurs
 * @property Collection|Programme[] $programmes
 *
 * @package App\Models
 */
class Region extends Model
{
    use HasFactory;
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

	public function operateurs()
	{
		return $this->belongsToMany(Operateur::class, 'operateursregions', 'regions_id', 'operateurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function programmes()
	{
		return $this->belongsToMany(Programme::class, 'programmesregions', 'regions_id', 'programmes_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
