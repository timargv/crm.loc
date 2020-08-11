<?php

namespace App\Entity;

use App\Entity\UserCapability\Vacation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property array role
 * @property string surname
 * @property string name
 * @property string patronymic
 */
class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_ADMIN = 'admin'; // Администратор
    public const ROLE_DIRECTOR = 'director'; // Директор
    public const ROLE_COLLABORATOR = 'collaborator'; // Сотрудник

    protected $table = 'users';
    protected $guarded = ['id'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function roleLists() : array
    {
        return [
            self::ROLE_COLLABORATOR => __('Сотрудник'),
            self::ROLE_DIRECTOR => __('Директор'),
            self::ROLE_ADMIN => __('Администратор'),
        ];
    }

    public function vacations ()
    {
        return $this->hasMany(Vacation::class, 'user_id', 'id');
    }

    public function isAdmin(): bool
    {

//        dd(in_array(self::ROLE_ADMIN, $this->role));
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDirector(): bool
    {

//        dd(in_array(self::ROLE_ADMIN, $this->role));
        return $this->role === self::ROLE_DIRECTOR;
    }

    public function isCollaboration(): bool
    {

//        dd(in_array(self::ROLE_ADMIN, $this->role));
        return $this->role === self::ROLE_COLLABORATOR;
    }

    public function getFullName() : string
    {
        return $this->surname .' '. $this->name .' '. $this->patronymic;
    }




}
