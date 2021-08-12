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
 * Class DemandeursHasFormation
 * 
 * @property int $id
 * @property int $demandeurs_id
 * @property int $formations_id
 * @property Carbon|null $created_at
 * @property Carbon|null $update_at
 * @property string|null $deleted_at
 * 
 * @property Demandeur $demandeur
 * @property Formation $formation
 *
 * @package App\Models
 */
class DemandeursHasFormation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'demandeurs_has_formations';
	public $timestamps = false;

	protected $casts = [
		'demandeurs_id' => 'int',
		'formations_id' => 'int'
	];

	protected $dates = [
		'update_at'
	];

	protected $fillable = [
		'demandeurs_id',
		'formations_id',
		'update_at'
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
