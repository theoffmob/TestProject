<?php

namespace App\Http\Controllers;

use App\Model\Prize;

/**
 * Class WinPrizeController
 *
 * @package App\Http\Controllers
 */
class WinPrizeController extends Controller
{
    public function initprizes()
    {
        $random = Prize::inRandomOrder()->firstOrFail();
        return $random;
    }
}
