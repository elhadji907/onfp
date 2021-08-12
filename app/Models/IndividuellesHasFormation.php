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
 * Class IndividuellesHasFormation
 * 
 * @property int $id
 * @property int $individuelles_id
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Formation $formation
 * @property Individuelle $individuelle
 *
 * @package App\Models
 */
class IndividuellesHasFormation extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'individuelles_has_formations';

	protected $casts = [
		'individuelles_id' => 'int',
		'formations_id' => 'int'
	];

	protected $fillable = [
		'individuelles_id',
		'formations_id'
	];

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}

	public function individuelle()
	{
		return $this->belongsTo(Individuelle::class, 'individuelles_id');
	}
}
