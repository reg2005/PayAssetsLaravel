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
use reg2005\PayAssetsLaravel\Lib\ExchangeLib;
use reg2005\PayAssetsLaravel\Entities\Exchange;

class PayAssetsController extends Controller
{

    public function index()
    {
        $ps = (new ExchangeLib )->get_all();

        (new Exchange)->saveExchange($ps);

        return response()->json($ps);
    }
}