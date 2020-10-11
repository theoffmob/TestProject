<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UserWinning
 *
 * @package App\Model
 */
class UserWinning extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'typeid',
        'moneysum',
        'payoutstatus',
    ];

    /**
     * @var string
     */
    protected $table = 'user_winnings';

    /**
     * @return HasOne
     */
    public function User()
    {
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    /**
     * @param $status
     */
    protected function setStatus($status)
    {
        $this->payoutstatus = $status;
    }
}
