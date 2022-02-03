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
 * Class Zone
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property int|null $localites_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Localite|null $localite
 * @property Collection|Programme[] $programmes
 * @property Collection|Projet[] $projets
 *
 * @package App\Models
 */
class Zone extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'zones';

	protected $casts = [
		'localites_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'localites_id'
	];

	public function localite()
	{
		return $this->belongsTo(Localite::class, 'localites_id');
	}

	public function programmes()
	{
		return $this->belongsToMany(Programme::class, 'programmes_has_zones', 'zones_id', 'programmes_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function projets()
	{
		return $this->belongsToMany(Projet::class, 'projetszones', 'zones_id', 'projets_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}