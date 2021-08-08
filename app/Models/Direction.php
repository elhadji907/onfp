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
 * Class Direction
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $sigle
 * @property int|null $chef_id
 * @property int $types_directions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TypesDirection $types_direction
 * @property Collection|Courrier[] $courriers
 * @property Collection|Imputation[] $imputations
 * @property Collection|Division[] $divisions
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Direction extends Model
{
	use SoftDeletes;
	protected $table = 'directions';

	protected $casts = [
		'chef_id' => 'int',
		'types_directions_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'chef_id',
		'types_directions_id'
	];

	public function types_direction()
	{
		return $this->belongsTo(TypesDirection::class, 'types_directions_id');
	}

	public function courriers()
	{
		return $this->belongsToMany(Courrier::class, 'directions_has_courriers', 'directions_id', 'courriers_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function imputations()
	{
		return $this->belongsToMany(Imputation::class, 'directions_has_imputations', 'directions_id', 'imputations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}

	public function divisions()
	{
		return $this->hasMany(Division::class, 'directions_id');
	}

	public function employees()
	{
		return $this->hasMany(Employee::class, 'directions_id');
	}
}
