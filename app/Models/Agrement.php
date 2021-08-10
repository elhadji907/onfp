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
 * Class Agrement
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero
 * @property string|null $name
 * @property string|null $rccm
 * @property string|null $quitus
 * @property string|null $ninea
 * @property string|null $adresse
 * @property string|null $bp
 * @property string|null $email
 * @property string|null $prenom
 * @property string|null $nom
 * @property string|null $region
 * @property string|null $departement
 * @property string|null $commune
 * @property string|null $type
 * @property string|null $details
 * @property int|null $gestionnaires_id
 * @property int|null $operateurs_id
 * @property int|null $responsables_id
 * @property int|null $quitus_id
 * @property int|null $rccms_id
 * @property int|null $nineas_id
 * @property int|null $courriers_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Courrier|null $courrier
 * @property Gestionnaire|null $gestionnaire
 * @property Operateur|null $operateur
 * @property Quitu|null $quitu
 * @property Responsable|null $responsable
 * @property Collection|AgrementsType[] $agrements_types
 *
 * @package App\Models
 */
class Agrement extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'agrements';

	protected $casts = [
		'gestionnaires_id' => 'int',
		'operateurs_id' => 'int',
		'responsables_id' => 'int',
		'quitus_id' => 'int',
		'rccms_id' => 'int',
		'nineas_id' => 'int',
		'courriers_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'name',
		'rccm',
		'quitus',
		'ninea',
		'adresse',
		'bp',
		'email',
		'prenom',
		'nom',
		'region',
		'departement',
		'commune',
		'type',
		'details',
		'gestionnaires_id',
		'operateurs_id',
		'responsables_id',
		'quitus_id',
		'rccms_id',
		'nineas_id',
		'courriers_id'
	];

	public function courrier()
	{
		return $this->belongsTo(Courrier::class, 'courriers_id');
	}

	public function gestionnaire()
	{
		return $this->belongsTo(Gestionnaire::class, 'gestionnaires_id');
	}

	public function ninea()
	{
		return $this->belongsTo(Ninea::class, 'nineas_id');
	}

	public function operateur()
	{
		return $this->belongsTo(Operateur::class, 'operateurs_id');
	}

	public function quitu()
	{
		return $this->belongsTo(Quitu::class, 'quitus_id');
	}

	public function rccm()
	{
		return $this->belongsTo(Rccm::class, 'rccms_id');
	}

	public function responsable()
	{
		return $this->belongsTo(Responsable::class, 'responsables_id');
	}

	public function agrements_types()
	{
		return $this->hasMany(AgrementsType::class, 'agrements_id');
	}
}
