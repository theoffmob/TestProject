<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prize
 *
 * @package App\Model
 */
class Prize extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'typeid',
        'money',
    ];

    /**
     * @var string
     */
    protected $table = 'prize';

    /**
     * @var bool
     */
    public $timestamps = false;
}
