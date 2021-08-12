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
 * Class Beneficiairesformation
 * 
 * @property int $beneficiaires_id
 * @property int $formations_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Beneficiaire $beneficiaire
 * @property Formation $formation
 *
 * @package App\Models
 */
class Beneficiairesformation extends Model
{
	use SoftDeletes;
	use HasFactory;
	use \App\Helpers\UuidForKey;
	protected $table = 'beneficiairesformations';
	protected $primaryKey = 'beneficiaires_id';

	protected $casts = [
		'formations_id' => 'int'
	];

	protected $fillable = [
		'formations_id'
	];

	public function beneficiaire()
	{
		return $this->belongsTo(Beneficiaire::class, 'beneficiaires_id');
	}

	public function formation()
	{
		return $this->belongsTo(Formation::class, 'formations_id');
	}
}
