<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Prestataire
 * 
 * @property int $id
 * @property string $uuid
 * @property string $matricule
 * @property int|null $employees_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee|null $employee
 *
 * @package App\Models
 */
class Prestataire extends Model
{
	use SoftDeletes;
	protected $table = 'prestataires';

	protected $casts = [
		'employees_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'matricule',
		'employees_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employees_id');
	}
}
