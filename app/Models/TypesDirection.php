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
 * Class TypesDirection
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Direction[] $directions
 *
 * @package App\Models
 */
class TypesDirection extends Model
{
	use SoftDeletes;
	protected $table = 'types_directions';

	protected $fillable = [
		'uuid',
		'name'
	];

	public function directions()
	{
		return $this->hasMany(Direction::class, 'types_directions_id');
	}
}
