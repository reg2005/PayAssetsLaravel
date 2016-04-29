<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 28.04.16
 * Time: 17:41
 */

namespace reg2005\PayAssetsLaravel\Http\Controllers;
use App\Http\Controllers\Controller;
use App;
use reg2005\QiwiPay\Lib\Qiwi;

class QiwiPayController extends Controller
{

    public function index()
    {
        $ps = (new Qiwi() )->run();

        return response()->json($ps);
    }
}