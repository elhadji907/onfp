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
 * @property float|null $note
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property int $demandeurs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 * @property Collection|Formation[] $formations
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
		'demandeurs_id' => 'int'
	];

	protected $dates = [
		'date1',
		'date_depot'
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
		'note',
		'statut',
		'items1',
		'date1',
		'date_depot',
		'demandeurs_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function formations()
	{
		return $this->belongsToMany(Formation::class, 'individuellesformations', 'individuelles_id', 'formations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'individuellesmodules', 'individuelles_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
