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
 * Class Arrondissement
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property int $departements_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement $departement
 * @property Collection|Commune[] $communes
 *
 * @package App\Models
 */
class Arrondissement extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'arrondissements';

	protected $casts = [
		'departements_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'departements_id'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'departements_id');
	}

	public function communes()
	{
		return $this->hasMany(Commune::class, 'arrondissements_id');
	}
}
