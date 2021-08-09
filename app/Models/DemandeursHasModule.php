<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DemandeursHasModule
 * 
 * @property int $id
 * @property int $demandeurs_id
 * @property int $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 * @property Module $module
 *
 * @package App\Models
 */
class DemandeursHasModule extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'demandeurs_has_modules';

	protected $casts = [
		'demandeurs_id' => 'int',
		'modules_id' => 'int'
	];

	protected $fillable = [
		'demandeurs_id',
		'modules_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}
}
