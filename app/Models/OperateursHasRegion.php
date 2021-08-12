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
 * Class OperateursHasRegion
 * 
 * @property int $id
 * @property int $operateurs_id
 * @property int $regions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Operateur $operateur
 * @property Region $region
 *
 * @package App\Models
 */
class OperateursHasRegion extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'operateurs_has_regions';

	protected $casts = [
		'operateurs_id' => 'int',
		'regions_id' => 'int'
	];

	protected $fillable = [
		'operateurs_id',
		'regions_id'
	];

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}
}
