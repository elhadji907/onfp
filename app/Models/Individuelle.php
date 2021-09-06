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
 * Class Individuelle
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $cin
 * @property int|null $nbre_pieces
 * @property string|null $legende
 * @property string|null $reference
 * @property string|null $experience
 * @property string|null $projet
 * @property string|null $prerequis
 * @property string|null $information
 * @property Carbon|null $date_depot
 * @property float|null $note
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property string|null $statut
 * @property string|null $type
 * @property int $demandeurs_id
 * @property int|null $formations_id
 * @property int|null $communes_id
 * @property int|null $etudes_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune|null $commune
 * @property Demandeur $demandeur
 * @property Etude|null $etude
 * @property Formation|null $formation
 * @property Collection|Module[] $modules
 *
 * @package App\Models
 */
class Individuelle extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuelles';

	protected $casts = [
		'nbre_pieces' => 'int',
		'note' => 'float',
		'demandeurs_id' => 'int',
		'formations_id' => 'int',
		'communes_id' => 'int',
		'etudes_id' => 'int'
	];

	protected $dates = [
		'date_depot',
		'date1'
	];

	protected $fillable = [
		'uuid',
		'cin',
		'nbre_pieces',
		'legende',
		'reference',
		'experience',
		'projet',
		'prerequis',
		'information',
		'date_depot',
		'note',
		'items1',
		'date1',
		'statut',
		'type',
		'demandeurs_id',
		'formations_id',
		'communes_id',
		'etudes_id'
	];

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

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'individuellesmodules', 'individuelles_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
