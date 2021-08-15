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
 * Class Evaluation
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero
 * @property string $name
 * @property Carbon|null $date
 * @property float|null $note
 * @property string|null $appreciation
 * @property string|null $mention
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Evaluateur[] $evaluateurs
 * @property Collection|Formation[] $formations
 *
 * @package App\Models
 */
class Evaluation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'evaluations';

	protected $casts = [
		'note' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'name',
		'date',
		'note',
		'appreciation',
		'mention'
	];

	public function evaluateurs()
	{
		return $this->belongsToMany(Evaluateur::class, 'evaluationsevaluateurs', 'evaluations_id', 'evaluateurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function formations()
	{
		return $this->belongsToMany(Formation::class, 'formationsevaluations', 'evaluations_id', 'formations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
