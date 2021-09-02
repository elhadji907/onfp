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
 * Class Fcollective
 * 
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property string|null $categorie
 * @property int $formations_id
 * @property int|null $modules_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Module|null $module
 * @property Formation $formation
 *
 * @package App\Models
 */
class Fcollective extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'fcollectives';

	protected $casts = [
		'formations_id' => 'int',
		'modules_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'code',
		'categorie',
		'formations_id',
		'modules_id'
	];

	public function module()
	{
		return $this->belongsTo(Module::class, 'modules_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
