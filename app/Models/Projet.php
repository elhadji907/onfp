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
 * Class Projet
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property Carbon|null $debut
 * @property Carbon|null $fin
 * @property float|null $budjet
 * @property string|null $locatite
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Courrier[] $courriers
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Depense[] $depenses
 *
 * @package App\Models
 */
class Projet extends Model
{
	use SoftDeletes;
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
		'debut',
		'fin',
		'budjet',
		'locatite'
	];

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'projets_id');
	}

	public function demandeurs()
	{
		return $this->hasMany(Demandeur::class, 'projets_id');
	}

	public function depenses()
	{
		return $this->hasMany(Depense::class, 'projets_id');
	}
}
