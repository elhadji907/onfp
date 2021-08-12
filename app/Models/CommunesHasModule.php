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
 * Class CommunesHasModule
 * 
 * @property int $id
 * @property int $communes_id
 * @property int $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Commune $commune
 * @property Module $module
 *
 * @package App\Models
 */
class CommunesHasModule extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'communes_has_modules';

	protected $casts = [
		'communes_id' => 'int',
		'modules_id' => 'int'
	];

	protected $fillable = [
		'communes_id',
		'modules_id'
	];

	public function commune()
	{
		return $this->belongsTo(Commune::class, 'communes_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
