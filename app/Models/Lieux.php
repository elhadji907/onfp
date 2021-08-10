<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Lieux
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Demandeur[] $demandeurs
 *
 * @package App\Models
 */
class Lieux extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'lieuxs';

	protected $fillable = [
		'uuid',
		'name'
	];

	public function demandeurs()
	{
		return $this->hasMany(Demandeur::class);
	}
}
