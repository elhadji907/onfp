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
 * Class EmployeesHasFormation
 * 
 * @property int $id
 * @property int $employees_id
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property Formation $formation
 *
 * @package App\Models
 */
class EmployeesHasFormation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'employees_has_formations';

	protected $casts = [
		'employees_id' => 'int',
		'formations_id' => 'int'
	];

	protected $fillable = [
		'employees_id',
		'formations_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employees_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
