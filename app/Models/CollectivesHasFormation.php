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
 * Class CollectivesHasFormation
 * 
 * @property int $id
 * @property int $collectives_id
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collective $collective
 * @property Formation $formation
 *
 * @package App\Models
 */
class CollectivesHasFormation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'collectives_has_formations';

	protected $casts = [
		'collectives_id' => 'int',
		'formations_id' => 'int'
	];

	protected $fillable = [
		'collectives_id',
		'formations_id'
	];

	public function collective()
	{
		return $this->belongsTo(Collective::class, 'collectives_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
