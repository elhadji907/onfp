<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Formationsevaluation
 * 
 * @property int $id
 * @property int $formations_id
 * @property int $evaluations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluation $evaluation
 * @property Formation $formation
 *
 * @package App\Models
 */
class Formationsevaluation extends Model
{
	use SoftDeletes;
	use HasFactory;
	use \App\Helpers\UuidForKey;
	protected $table = 'formationsevaluations';

	protected $casts = [
		'formations_id' => 'int',
		'evaluations_id' => 'int'
	];

	protected $fillable = [
		'formations_id',
		'evaluations_id'
	];

	public function evaluation()
	{
		return $this->belongsTo(Evaluation::class, 'evaluations_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
