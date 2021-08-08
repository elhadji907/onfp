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
 * Class Facture
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $numero
 * @property Carbon|null $date_etablissement
 * @property string|null $details
 * @property float|null $montant1
 * @property float|null $montant2
 * @property float|null $autre_montant
 * @property float|null $total
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Formation[] $formations
 * @property Collection|Reglement[] $reglements
 *
 * @package App\Models
 */
class Facture extends Model
{
	use SoftDeletes;
	protected $table = 'factures';

	protected $casts = [
		'montant1' => 'float',
		'montant2' => 'float',
		'autre_montant' => 'float',
		'total' => 'float'
	];

	protected $dates = [
		'date_etablissement'
	];

	protected $fillable = [
		'uuid',
		'numero',
		'date_etablissement',
		'details',
		'montant1',
		'montant2',
		'autre_montant',
		'total'
	];

	public function formations()
	{
		return $this->hasMany(Formation::class, 'factures_id');
	}

	public function reglements()
	{
		return $this->hasMany(Reglement::class, 'factures_id');
	}
}
