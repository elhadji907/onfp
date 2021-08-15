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
 * Class Evaluationsevaluateur
 * 
 * @property int $id
 * @property int $evaluations_id
 * @property int $evaluateurs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluateur $evaluateur
 * @property Evaluation $evaluation
 *
 * @package App\Models
 */
class Evaluationsevaluateur extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'evaluationsevaluateurs';

	protected $casts = [
		'evaluations_id' => 'int',
		'evaluateurs_id' => 'int'
	];

	protected $fillable = [
		'evaluations_id',
		'evaluateurs_id'
	];

	public function evaluateur()
	{
		return $this->belongsTo(Evaluateur::class, 'evaluateurs_id');
	}

	public function evaluation()
	{
		return $this->belongsTo(Evaluation::class, 'evaluations_id');
	}
}
