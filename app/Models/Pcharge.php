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
 * Class Pcharge
 * 
 * @property int $id
 * @property string $uuid
 * @property string $cin
 * @property string|null $items1
 * @property Carbon|null $date1
 * @property int|null $duree
 * @property float|null $accompt
 * @property float|null $reliquat
 * @property int|null $demandeurs_id
 * @property int|null $ecoles_id
 * @property int|null $annee
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Demandeur|null $demandeur
 * @property Etablissement|null $etablissement
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
		'duree' => 'int',
		'accompt' => 'float',
		'reliquat' => 'float',
		'demandeurs_id' => 'int',
		'ecoles_id' => 'int',
		'annee' => 'int'
	];

	protected $dates = [
		'date1'
	];

	protected $fillable = [
		'uuid',
		'cin',
		'items1',
		'date1',
		'duree',
		'accompt',
		'reliquat',
		'demandeurs_id',
		'ecoles_id',
		'annee'
	];

	public function demandeur()
	{
		return $this->belongsTo(Demandeur::class, 'demandeurs_id');
	}

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class, 'ecoles_id');
	}
}
