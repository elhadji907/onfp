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
 * Class Individuelleslocalite
 * 
 * @property int $id
 * @property int $individuelles_id
 * @property int $localites_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Individuelle $individuelle
 * @property Localite $localite
 *
 * @package App\Models
 */
class Individuelleslocalite extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuelleslocalites';

	protected $casts = [
		'individuelles_id' => 'int',
		'localites_id' => 'int'
	];

	protected $fillable = [
		'individuelles_id',
		'localites_id'
	];

	public function individuelle()
	{
		return $this->belongsTo(Individuelle::class, 'individuelles_id');
	}

	public function localite()
	{
		return $this->belongsTo(Localite::class, 'localites_id');
	}
}
