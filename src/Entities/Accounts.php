<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Accounts extends Model {

    protected $fillable = ['RUB', 'EUR', 'BTC', 'USD', 'in_turnover_current_monthly', 'out_turnover_current_monthly'];

    protected $table = 'reg2005_accounts';


    public function get_qiwi(){

        $item = $this
            ->orderBy('last_use', 'asc')
            ->where('no_active', '=', '0')
            ->where('type', '=', 'QIWI')
            ->where('error_out_pays', '<', 2)

            //таймаут для кошелька, чтоб не банили->get();
            ->where('last_use', '<', Carbon::now()->subSeconds(15))
            ->first();

        if($item) {

            $item->last_use = Carbon::now();

            $item->save();

        }

        return $item;

    }

    public function get_pm(){

        $item = $this
            ->orderBy('last_use', 'asc')
            ->where('no_active', '=', '0')
            ->where('type', '=', 'PM')

            //таймаут для кошелька, чтоб не банили->get();
            ->where('last_use', '<', Carbon::now()->subSeconds(15))
            ->first();

        if($item) {

            $item->last_use = Carbon::now();

            $item->save();

        }

        return $item;
    }

    public function get_bitcoin(){

        $item = $this
            ->orderBy('last_use', 'asc')
            ->where('no_active', '=', '0')
            ->where('type', '=', 'BTC')

            ->first();

        if($item) {

            $item->last_use = Carbon::now();

            $item->save();

        }

        return $item;

    }

}