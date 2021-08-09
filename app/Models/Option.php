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
 * Class Option
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $titre1
 * @property Carbon|null $date1
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Diplome[] $diplomes
 *
 * @package App\Models
 */
class Option extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'options';

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'titre1',
		'date1'
	];

	public function diplomes()
	{
		return $this->hasMany(Diplome::class, 'options_id');
	}
}
