<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Diplome
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $sigle
 * @property string|null $titre1
 * @property Carbon|null $date1
 * @property int|null $options_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Option|null $option
 * @property Collection|Demandeur[] $demandeurs
 *
 * @package App\Models
 */
class Diplome extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'diplomes';

	protected $casts = [
		'options_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'titre1',
		'date1',
		'options_id'
	];

	public function option()
	{
		return $this->belongsTo(Option::class, 'options_id');
	}

	public function demandeurs()
	{
		return $this->belongsToMany(Demandeur::class, 'demandeurs_has_diplomes', 'diplomes_id', 'demandeurs_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
