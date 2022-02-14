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
 * Class Individuellesmodule
 * 
 * @property int $id
 * @property int $individuelles_id
 * @property int $modules_id
 * @property int|null $individuellemodulestatut_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Individuelle $individuelle
 * @property Module $module
 * @property Individuellemodulestatut|null $individuellemodulestatut
 *
 * @package App\Models
 */
class Individuellesmodule extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuellesmodules';

	protected $casts = [
		'individuelles_id' => 'int',
		'modules_id' => 'int',
		'individuellemodulestatut_id' => 'int'
	];

	protected $fillable = [
		'individuelles_id',
		'modules_id',
		'individuellemodulestatut_id'
	];

	public function individuelle()
	{
		return $this->belongsTo(Individuelle::class, 'individuelles_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}

	public function individuellemodulestatut()
	{
		return $this->belongsTo(Individuellemodulestatut::class);
	}
}
