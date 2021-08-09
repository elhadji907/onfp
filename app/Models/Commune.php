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
 * Class Commune
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property string|null $adresse
 * @property int $arrondissements_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Arrondissement $arrondissement
 * @property Collection|Operateur[] $operateurs
 * @property Collection|Village[] $villages
 *
 * @package App\Models
 */
class Commune extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'communes';

	protected $casts = [
		'arrondissements_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'adresse',
		'arrondissements_id'
	];

	public function arrondissement()
	{
		return $this->belongsTo(Arrondissement::class, 'arrondissements_id');
	}

	public function operateurs()
	{
		return $this->hasMany(Operateur::class, 'communes_id');
	}

	public function villages()
	{
		return $this->hasMany(Village::class, 'communes_id');
	}
}
