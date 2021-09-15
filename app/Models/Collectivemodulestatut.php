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
 * Class Collectivemodulestatut
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $statut
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Collectivesmodule[] $collectivesmodules
 *
 * @package App\Models
 */
class Collectivemodulestatut extends Model
{
	use SoftDeletes;
	protected $table = 'collectivemodulestatut';

	protected $fillable = [
		'uuid',
		'statut'
	];

	public function collectivesmodules()
	{
		return $this->hasMany(Collectivesmodule::class);
	}
}
