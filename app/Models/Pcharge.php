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
 * Class Pcharge
 * 
 * @property int $id
 * @property string $uuid
 * @property int $annee
 * @property string|null $matricule
 * @property string|null $typedemande
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property int|null $duree
 * @property float|null $montant
 * @property float|null $accompt
 * @property float|null $reliquat
 * @property int|null $demandeurs_id
 * @property int|null $etablissements_id
 * @property string|null $file1
 * @property string|null $file2
 * @property string|null $file3
 * @property string|null $file4
 * @property string|null $file5
 * @property string|null $file6
 * @property string|null $file7
 * @property string|null $file8
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur|null $demandeur
 * @property Etablissement|null $etablissement
 * @property Collection|Nouvelle[] $nouvelles
 * @property Collection|Renouvellement[] $renouvellements
 *
 * @package App\Models
 */
class Pcharge extends Model
{
    use HasFactory;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'pcharges';

	protected $casts = [
		'annee' => 'int',
		'duree' => 'int',
		'montant' => 'float',
		'accompt' => 'float',
		'reliquat' => 'float',
		'demandeurs_id' => 'int',
		'etablissements_id' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'annee',
		'matricule',
		'typedemande',
		'items1',
		'date1',
		'duree',
		'montant',
		'accompt',
		'reliquat',
		'demandeurs_id',
		'etablissements_id',
		'file1',
		'file2',
		'file3',
		'file4',
		'file5',
		'file6',
		'file7',
		'file8'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class, 'etablissements_id');
	}

	public function nouvelles()
	{
		return $this->hasMany(Nouvelle::class, 'pcharges_id');
	}

	public function renouvellements()
	{
		return $this->hasMany(Renouvellement::class, 'pcharges_id');
	}
}
