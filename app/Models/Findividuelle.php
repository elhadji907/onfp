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
 * Class Findividuelle
 * 
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property string|null $categorie
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Formation $formation
 *
 * @package App\Models
 */
class Findividuelle extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'findividuelles';

	protected $casts = [
		'formations_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'code',
		'categorie',
		'formations_id'
	];

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
