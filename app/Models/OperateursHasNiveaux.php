<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperateursHasNiveaux
 * 
 * @property int $operateurs_id
 * @property int $niveaux_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Niveaux $niveaux
 * @property Operateur $operateur
 *
 * @package App\Models
 */
class OperateursHasNiveaux extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'operateurs_has_niveaux';
	protected $primaryKey = 'operateurs_id';

	protected $casts = [
		'niveaux_id' => 'int'
	];

	protected $fillable = [
		'niveaux_id'
	];

	public function niveaux()
	{
		return $this->belongsTo(Niveaux::class);
	}

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}
}
