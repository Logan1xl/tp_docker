<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Personnel
 *
 * @property string $code_pers
 * @property string $nom_pers
 * @property string $login_pers
 * @property string $pwd_pers
 * @property string $email_pers
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Personnel extends Authenticatable
{
    use HasApiTokens;
	protected $table = 'personnels';
	protected $primaryKey = 'code_pers';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nom_pers',
		'login_pers',
		'pwd_pers',
		'email_pers',
		'id'
	];
}
