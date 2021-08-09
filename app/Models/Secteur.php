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
 * Class Secteur
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Domaine[] $domaines
 *
 * @package App\Models
 */
class Secteur extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'secteurs';

	protected $fillable = [
		'uuid',
		'name'
	];

	public function domaines()
	{
		return $this->hasMany(Domaine::class, 'secteurs_id');
	}
}
