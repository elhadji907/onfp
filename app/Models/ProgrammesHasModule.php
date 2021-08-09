<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProgrammesHasModule
 * 
 * @property int $id
 * @property int $programmes_id
 * @property int $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Module $module
 * @property Programme $programme
 *
 * @package App\Models
 */
class ProgrammesHasModule extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'programmes_has_modules';

	protected $casts = [
		'programmes_id' => 'int',
		'modules_id' => 'int'
	];

	protected $fillable = [
		'programmes_id',
		'modules_id'
	];

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}

	public function programme()
	{
		return $this->belongsTo(Programme::class, 'programmes_id');
	}
}
