<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrdresMission
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero
 * @property Carbon|null $date_recep
 * @property string|null $beneficiaire
 * @property float|null $montant
 * @property Carbon|null $date_depart
 * @property Carbon|null $date_retour
 * @property Carbon|null $date_transmission
 * @property Carbon|null $date_dg
 * @property Carbon|null $date_cg
 * @property Carbon|null $date_ac
 * @property int|null $employees_id
 * @property int $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Courrier $courrier
 * @property Employee|null $employee
 *
 * @package App\Models
 */
class OrdresMission extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'ordres_missions';

	protected $casts = [
		'montant' => 'float',
		'employees_id' => 'int',
		'courriers_id' => 'int'
	];

	protected $dates = [
		'date_recep',
		'date_depart',
		'date_retour',
		'date_transmission',
		'date_dg',
		'date_cg',
		'date_ac'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'date_recep',
		'beneficiaire',
		'montant',
		'date_depart',
		'date_retour',
		'date_transmission',
		'date_dg',
		'date_cg',
		'date_ac',
		'employees_id',
		'courriers_id'
	];

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employees_id');
	}
}
