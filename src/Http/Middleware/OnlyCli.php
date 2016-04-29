<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 28.04.16
 * Time: 19:28
 */
namespace reg2005\PayAssetsLaravel\Http\Middleware;

use Closure;
use App;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OnlyCli {


    public function handle($request, Closure $next)
    {
        $conf_debug = \Config::get('app.debug');

        // if debug_mode == TRUE in your Application
        if($conf_debug == false) {

            //if run from browser
            if (!App::runningInConsole()) {

                //dd("I'm run only in the console, baby!");
                throw new HttpException(404);

            }
        }

        return $next($request);
    }
}