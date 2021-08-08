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
 * Class Ingenieur
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $sigle
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $specialite
 * @property Carbon|null $date
 * @property string|null $items1
 * @property string|null $items2
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Formation[] $formations
 *
 * @package App\Models
 */
class Ingenieur extends Model
{
	use SoftDeletes;
	protected $table = 'ingenieurs';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'name',
		'sigle',
		'telephone',
		'email',
		'specialite',
		'date',
		'items1',
		'items2'
	];

	public function formations()
	{
		return $this->hasMany(Formation::class, 'ingenieurs_id');
	}
}
