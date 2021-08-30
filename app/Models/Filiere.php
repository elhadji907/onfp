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
 * Class Filiere
 * 
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $domaine
 * @property int|null $specialites_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Specialite|null $specialite
 * @property Collection|Etablissement[] $etablissements
 * @property Collection|Pcharge[] $pcharges
 *
 * @package App\Models
 */
class Filiere extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'filieres';

	protected $casts = [
		'specialites_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'name',
		'domaine',
		'specialites_id'
	];

	public function specialite()
	{
		return $this->belongsTo(Specialite::class, 'specialites_id');
	}

	public function etablissements()
	{
		return $this->hasMany(Etablissement::class, 'filieres_id');
	}

	public function pcharges()
	{
		return $this->hasMany(Pcharge::class, 'filieres_id');
	}
}
