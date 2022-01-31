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
 * Class Projet
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property string|null $description
 * @property Carbon|null $debut
 * @property Carbon|null $fin
 * @property float|null $budjet
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Collective[] $collectives
 * @property Collection|Courrier[] $courriers
 * @property Collection|Depense[] $depenses
 * @property Collection|Individuelle[] $individuelles
 * @property Collection|Localite[] $localites
 *
 * @package App\Models
 */
class Projet extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'projets';

	protected $casts = [
		'budjet' => 'float'
	];

	protected $dates = [
		'debut',
		'fin'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'description',
		'debut',
		'fin',
		'budjet'
	];

	public function collectives()
	{
		return $this->hasMany(Collective::class, 'projets_id');
	}

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'projets_id');
	}

	public function depenses()
	{
		return $this->hasMany(Depense::class, 'projets_id');
	}

	public function individuelles()
	{
		return $this->hasMany(Individuelle::class, 'projets_id');
	}

	public function localites()
	{
		return $this->hasMany(Localite::class, 'projets_id');
	}
}
