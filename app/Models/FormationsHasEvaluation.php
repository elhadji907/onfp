<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FormationsHasEvaluation
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
class FormationsHasEvaluation extends Model
{
	use SoftDeletes;
	protected $table = 'formations_has_evaluations';

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
