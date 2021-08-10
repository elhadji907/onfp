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
 * Class Departement
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property int $regions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Region $region
 * @property Collection|Arrondissement[] $arrondissements
 *
 * @package App\Models
 */
class Departement extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'departements';

	protected $casts = [
		'regions_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'regions_id'
	];

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}

	public function arrondissements()
	{
		return $this->hasMany(Arrondissement::class, 'departements_id');
	}
}
