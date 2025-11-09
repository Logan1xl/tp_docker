<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Traitement
 * 
 * @property string $code
 * @property int $id
 * @property Carbon $date_req
 * @property string $contenu
 * @property int $statut
 * @property int $service
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Traitement extends Model
{
	protected $table = 'traitements';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'date_req' => 'datetime',
		'statut' => 'int',
		'service' => 'int'
	];

	protected $fillable = [
		'date_req',
		'contenu',
		'statut',
		'service'
	];
}
