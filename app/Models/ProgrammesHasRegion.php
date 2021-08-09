<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProgrammesHasRegion
 * 
 * @property int $id
 * @property int $programmes_id
 * @property int $regions_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Programme $programme
 * @property Region $region
 *
 * @package App\Models
 */
class ProgrammesHasRegion extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'programmes_has_regions';

	protected $casts = [
		'programmes_id' => 'int',
		'regions_id' => 'int'
	];

	protected $fillable = [
		'programmes_id',
		'regions_id'
	];

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}

	public function region()
	{
		return $this->belongsTo(Region::class, 'regions_id');
	}
}
