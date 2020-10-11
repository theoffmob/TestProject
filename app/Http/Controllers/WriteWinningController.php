<?php

namespace App\Http\Controllers;

use App\Enums\PayoutStatus;
use App\Model\UserWinning;
use Auth;
use http\Exception;
use Illuminate\Http\Request;

/**
 * Class WriteWinning
 *
 * @package App\Http\Controllers
 */
class WriteWinningController extends Controller
{
    protected function createwin(Request $request)
    {
        try {
            UserWinning::create([
                                    'user_id' => Auth::user()->id,
                                    'typeid' => $request['typeid'],
                                    'moneysum' => $request['money'],
                                    'payoutstatus' => PayoutStatus::PENDING,
                                ]);
            return json_encode(
                [
                    'result' => true,
                    'message' => 'Success'
                ]
            );
        } catch (Exception $ex) {
            return json_encode(
                [
                    'result' => false,
                    'message' => 'Invalid format'
                ]
            );
        }
    }
}
