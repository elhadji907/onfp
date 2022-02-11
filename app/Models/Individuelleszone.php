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
 * Class Individuelleszone
 * 
 * @property int $id
 * @property int $individuelles_id
 * @property int $zones_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Individuelle $individuelle
 * @property Zone $zone
 *
 * @package App\Models
 */
class Individuelleszone extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuelleszones';

	protected $casts = [
		'individuelles_id' => 'int',
		'zones_id' => 'int'
	];

	protected $fillable = [
		'individuelles_id',
		'zones_id'
	];

	public function individuelle()
	{
		return $this->belongsTo(Individuelle::class, 'individuelles_id');
	}

	public function zone()
	{
		return $this->belongsTo(Zone::class, 'zones_id');
	}
}
