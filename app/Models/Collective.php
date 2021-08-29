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
 * Class Collective
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $sigle
 * @property string|null $statut
 * @property string|null $description
 * @property int $demandeurs_id
 * @property int|null $ingenieurs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 * @property Ingenieur|null $ingenieur
 * @property Collection|Formation[] $formations
 * @property Collection|Module[] $modules
 * @property Collection|Membre[] $membres
 *
 * @package App\Models
 */
class Collective extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'collectives';

	protected $casts = [
		'demandeurs_id' => 'int',
		'ingenieurs_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'items1',
		'date1',
		'sigle',
		'statut',
		'description',
		'demandeurs_id',
		'ingenieurs_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
	}

	public function formations()
	{
		return $this->belongsToMany(Formation::class, 'collectivesformations', 'collectives_id', 'formations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'collectivesmodules', 'collectives_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function membres()
	{
		return $this->hasMany(Membre::class, 'collectives_id');
	}
}
