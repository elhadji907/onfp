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
 * Class Role
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
		use SoftDeletes;
	use \App\Helpers\UuidForKey;
	
	protected $table = 'roles';

	protected $fillable = [
		'uuid',
		'name'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'roles_id');
	}
}
