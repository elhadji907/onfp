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
 * Class Localite
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $nom
 * @property int $projets_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Projet $projet
 * @property Collection|Zone[] $zones
 *
 * @package App\Models
 */
class Localite extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'localites';

	protected $casts = [
		'projets_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'projets_id'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}

	public function zones()
	{
		return $this->hasMany(Zone::class, 'localites_id');
	}
}
