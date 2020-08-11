<?php

namespace App\Entity\UserCapability;

use App\Entity\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int id
 * @property string status
 */
class Vacation extends Model
{
    public const STATUS_WAIT = 'wait';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_NOT_COMPLETED = 'not_completed';

    protected $table = 'vacations';
    protected $guarded = ['id'];

    protected $casts = [
        'date_from' => 'datetime:d.m.Y',
        'date_to' => 'datetime:d.m.Y',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function statusLists() : array
    {
        return [
            self::STATUS_WAIT => __('Ожидает проверку'),
            self::STATUS_COMPLETED => __('Подтверждено'),
            self::STATUS_NOT_COMPLETED => __('Не Подтверждено')
        ];
    }

    public function isWait() :bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isCompleted() :bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isNotCompleted() :bool
    {
        return $this->status === self::STATUS_NOT_COMPLETED;
    }

    public function getUserFullName() : string
    {
        return $this->user->getFullName();
    }
}
