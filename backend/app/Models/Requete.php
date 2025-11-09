<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Requete
 * 
 * @property string $code
 * @property string $objet
 * @property string $description
 * @property string $preuve
 * @property string $matricule
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Requete extends Model
{
	protected $table = 'requetes';
	protected $primaryKey = 'code';
	public $incrementing = false;

	protected $fillable = [
		'objet',
		'description',
		'preuve',
		'matricule'
	];
}
