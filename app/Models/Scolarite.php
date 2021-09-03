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
 * Class Scolarite
 * 
 * @property int $id
 * @property string $uuid
 * @property string $annee
 * @property Carbon|null $date
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Pcharge[] $pcharges
 *
 * @package App\Models
 */
class Scolarite extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'scolarites';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'annee',
		'date'
	];

	public function pcharges()
	{
		return $this->hasMany(Pcharge::class, 'scolarites_id');
	}
}
