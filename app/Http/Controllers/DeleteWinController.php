<?php

namespace App\Http\Controllers;

use App\Model\Prize;
use Illuminate\Database\Eloquent\Model;

class DeleteWinController extends Model
{
    protected function DeleteWin($id)
    {
        Prize::destroy($id);
    }
}
