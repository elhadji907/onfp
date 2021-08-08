<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Evaluateur
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $adresse
 * @property Carbon|null $date
 * @property string|null $fonction
 * @property string|null $appreciation
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Module[] $modules
 * @property Collection|Evaluation[] $evaluations
 *
 * @package App\Models
 */
class Evaluateur extends Model
{
	use SoftDeletes;
	protected $table = 'evaluateurs';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'name',
		'telephone',
		'email',
		'adresse',
		'date',
		'fonction',
		'appreciation'
	];

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'evaluateurs_has_modules', 'evaluateurs_id', 'modules_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function evaluations()
	{
		return $this->belongsToMany(Evaluation::class, 'evaluations_has_evaluateurs', 'evaluateurs_id', 'evaluations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
