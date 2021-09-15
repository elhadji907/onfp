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
 * Class Collectivesmodule
 * 
 * @property int $id
 * @property int $collectives_id
 * @property int $modules_id
 * @property int|null $collectivemodulestatut_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collectivemodulestatut|null $collectivemodulestatut
 * @property Collective $collective
 * @property Module $module
 *
 * @package App\Models
 */
class Collectivesmodule extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'collectivesmodules';

	protected $casts = [
		'collectives_id' => 'int',
		'modules_id' => 'int',
		'collectivemodulestatut_id' => 'int'
	];

	protected $fillable = [
		'collectives_id',
		'modules_id',
		'collectivemodulestatut_id'
	];

	public function collectivemodulestatut()
	{
		return $this->belongsTo(Collectivemodulestatut::class);
	}

	public function collective()
	{
		return $this->belongsTo(Collective::class, 'collectives_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
