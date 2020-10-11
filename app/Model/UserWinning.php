<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        //return $this->belongsTo('App\Model\User', 'user_email', ‘user_email’);
        return  $this->hasOne('App\Model\User', 'id', 'user_id');
       //return $email = $this['email'];
    }

    /**
     * @param $status
     */
    protected function setStatus($status){
        $this->payoutstatus = $status;
    }
}
