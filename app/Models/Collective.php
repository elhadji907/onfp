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
 * @property Carbon|null $date_depot
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $sigle
 * @property string|null $statut
 * @property string|null $description
 * @property string|null $type
 * @property int $demandeurs_id
 * @property int|null $ingenieurs_id
 * @property int|null $formations_id
 * @property int|null $communes_id
 * @property int|null $etudes_id
 * @property int|null $antennes_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Antenne|null $antenne
 * @property Commune|null $commune
 * @property Demandeur $demandeur
 * @property Etude|null $etude
 * @property Formation|null $formation
 * @property Ingenieur|null $ingenieur
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
		'ingenieurs_id' => 'int',
		'formations_id' => 'int',
		'communes_id' => 'int',
		'etudes_id' => 'int',
		'antennes_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'date_depot',
		'items1',
		'date1',
		'sigle',
		'statut',
		'description',
		'type',
		'demandeurs_id',
		'ingenieurs_id',
		'formations_id',
		'communes_id',
		'etudes_id',
		'antennes_id'
	];

	public function antenne()
	{
		return $this->belongsTo(Antenne::class, 'antennes_id');
	}

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function etude()
	{
		return $this->belongsTo(Etude::class, 'etudes_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}

	public function ingenieur()
	{
		return $this->belongsTo(Ingenieur::class, 'ingenieurs_id');
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
