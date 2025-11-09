<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Etudiant
 *
 * @property string $matricule
 * @property string $nom
 * @property string|null $prenom
 * @property string $sexe
 * @property string $email
 * @property string $telephone
 * @property string $login
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Etudiant extends Authenticatable
{
    use HasApiTokens, HasFactory;
	protected $table = 'etudiants';
	protected $primaryKey = 'matricule';
	public $incrementing = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
        'matricule',
		'nom',
		'prenom',
		'sexe',
		'email',
		'telephone',
		'login',
		'password'
	];
}
