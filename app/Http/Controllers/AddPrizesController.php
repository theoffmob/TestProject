<?php

namespace App\Http\Controllers;

use App\Model\Prize;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;


/**
 * Class AddPrizes
 *
 * @package App\Http\Controllers
 */
class AddPrizes extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function insert(Request $request)
    {
        try {
            Prize::create(
                [
                    'money' => $request->input('amount'),
                    "typeid" => $request->input('type'),
                ]
            );

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
