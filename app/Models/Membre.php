<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Membre
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $firtname
 * @property string|null $cin
 * @property Carbon|null $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $niveaux
 * @property string|null $experience_domaine
 * @property string|null $autre_experience
 * @property string|null $titre1
 * @property Carbon|null $date1
 * @property int $collectives_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collective $collective
 *
 * @package App\Models
 */
class Membre extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'membres';

	protected $casts = [
		'collectives_id' => 'int'
	];

	protected $dates = [
		'date_naissance',
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'firtname',
		'cin',
		'date_naissance',
		'lieu_naissance',
		'niveaux',
		'experience_domaine',
		'autre_experience',
		'titre1',
		'date1',
		'collectives_id'
	];

	public function collective()
	{
		return $this->belongsTo(Collective::class, 'collectives_id');
	}
}
