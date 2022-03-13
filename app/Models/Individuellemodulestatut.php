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
 * Class Individuellemodulestatut
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $statut
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Individuellesmodule[] $individuellesmodules
 *
 * @package App\Models
 */
class Individuellemodulestatut extends Model
{
	use SoftDeletes;
	protected $table = 'individuellemodulestatut';

	protected $fillable = [
		'uuid',
		'statut'
	];

	public function individuellesmodules()
	{
		return $this->hasMany(Individuellesmodule::class)->latest();
	}
}
