<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ingenieur
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $matricule
 * @property string $name
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
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'ingenieurs';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'uuid',
		'matricule',
		'name',
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
