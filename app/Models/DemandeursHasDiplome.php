<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DemandeursHasDiplome
 * 
 * @property int $id
 * @property int $demandeurs_id
 * @property int $diplomes_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 * @property Diplome $diplome
 *
 * @package App\Models
 */
class DemandeursHasDiplome extends Model
{
	use SoftDeletes;
	protected $table = 'demandeurs_has_diplomes';

	protected $casts = [
		'demandeurs_id' => 'int',
		'diplomes_id' => 'int'
	];

	protected $fillable = [
		'demandeurs_id',
		'diplomes_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function diplome()
	{
		return $this->belongsTo(Diplome::class, 'diplomes_id');
	}
}
