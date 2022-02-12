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
 * Class Diplomespro
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
 * @package App\Models
 */
class Diplomespro extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'diplomespros';

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
}
