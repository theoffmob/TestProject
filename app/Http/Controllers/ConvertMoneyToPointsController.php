<?php

namespace App\Http\Controllers;

use App\Enums\Сoefficient;
use App\Enums\PrizeTypes;
use Exception;
use Illuminate\Http\Request;



/**
 * Class ConvertMoneyToPointsController
 *
 * @package App\Http\Controllers
 */
class ConvertMoneyToPointsController extends Controller
{
    /**
     * @param Request $request
     */
    public function convert(Request $request)
    {
        try
        {
            $conveted =  [
                'type' => PrizeTypes::TYPE_BONUS,
                'money' => round(($request['money'] * Сoefficient::COEFF), 0)
            ];
            return $conveted;
        }
        catch (Exception $ex) {
            return json_encode(
                [
                    'result' => false,
                    'message' => 'Invalid format'
                ]
            );
        }
    }
}