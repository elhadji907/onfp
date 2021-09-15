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
 * Class Modulesoperateur
 * 
 * @property int $id
 * @property int $modules_id
 * @property int $operateurs_id
 * @property int|null $moduleoperateurstatut_id
 * @property string|null $specialites
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Moduleoperateurstatut|null $moduleoperateurstatut
 * @property Module $module
 * @property Operateur $operateur
 *
 * @package App\Models
 */
class Modulesoperateur extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'modulesoperateurs';

	protected $casts = [
		'modules_id' => 'int',
		'operateurs_id' => 'int',
		'moduleoperateurstatut_id' => 'int'
	];

	protected $fillable = [
		'modules_id',
		'operateurs_id',
		'moduleoperateurstatut_id',
		'specialites'
	];

	public function moduleoperateurstatut()
	{
		return $this->belongsTo(Moduleoperateurstatut::class);
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}
}
