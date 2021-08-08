<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DemandeursHasFormation
 * 
 * @property int $id
 * @property int $demandeurs_id
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 * @property Formation $formation
 *
 * @package App\Models
 */
class DemandeursHasFormation extends Model
{
	use SoftDeletes;
	protected $table = 'demandeurs_has_formations';

	protected $casts = [
		'demandeurs_id' => 'int',
		'formations_id' => 'int'
	];

	protected $fillable = [
		'demandeurs_id',
		'formations_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
