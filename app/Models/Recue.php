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
 * Class Recue
 * 
 * @property int $id
 * @property string|null $numero
 * @property string $uuid
 * @property int $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Courrier $courrier
 *
 * @package App\Models
 */
class Recue extends Model
{
	
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'recues';

	protected $casts = [
		'courriers_id' => 'int'
	];

	protected $fillable = [
		'numero',
		'uuid',
		'courriers_id'
	];

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}
}
