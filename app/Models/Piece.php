<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Piece
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $piece1
 * @property string|null $piece2
 * @property string|null $piece3
 * @property string|null $piece4
 * @property string|null $piece5
 * @property string|null $piece6
 * @property string|null $piece7
 * @property string|null $piece8
 * @property string|null $piece9
 * @property string|null $piece10
 * @property string|null $piece11
 * @property string|null $piece12
 * @property string|null $piece13
 * @property string|null $piece14
 * @property string|null $piece15
 * @property int $demandeurs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur $demandeur
 *
 * @package App\Models
 */
class Piece extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'pieces';

	protected $casts = [
		'demandeurs_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'piece1',
		'piece2',
		'piece3',
		'piece4',
		'piece5',
		'piece6',
		'piece7',
		'piece8',
		'piece9',
		'piece10',
		'piece11',
		'piece12',
		'piece13',
		'piece14',
		'piece15',
		'demandeurs_id'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}
}
