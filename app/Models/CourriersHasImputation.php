<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourriersHasImputation
 * 
 * @property int $id
 * @property int $courriers_id
 * @property int $imputations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Courrier $courrier
 * @property Imputation $imputation
 *
 * @package App\Models
 */
class CourriersHasImputation extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'courriers_has_imputations';

	protected $casts = [
		'courriers_id' => 'int',
		'imputations_id' => 'int'
	];

	protected $fillable = [
		'courriers_id',
		'imputations_id'
	];

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function imputation()
	{
		return $this->belongsTo(Imputation::class, 'imputations_id');
	}
}
