<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EvaluateursHasModule
 * 
 * @property int $id
 * @property int $evaluateurs_id
 * @property int $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Evaluateur $evaluateur
 * @property Module $module
 *
 * @package App\Models
 */
class EvaluateursHasModule extends Model
{
	use SoftDeletes;
	protected $table = 'evaluateurs_has_modules';

	protected $casts = [
		'evaluateurs_id' => 'int',
		'modules_id' => 'int'
	];

	protected $fillable = [
		'evaluateurs_id',
		'modules_id'
	];

	public function evaluateur()
	{
		return $this->belongsTo(Evaluateur::class, 'evaluateurs_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
