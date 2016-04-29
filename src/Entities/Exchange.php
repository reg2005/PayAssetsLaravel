<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exchange extends Model {

    protected $fillable = ['Name', 'Currency', 'Rate', 'Ask', 'Bid', '-id'];

    protected $table = 'reg2005_exchanges';

    public function Xchange($currency, $amount = 0){

        //USD специально убран, т.к. нет смысла доллары переводить в доллары
        $allow = ['EUR', 'BTC', 'RUB', 'KZT', 'GOLD'];

        if(!in_array($currency, $allow))
            return $amount;

        $item = $this
            ->orderBy('updated_at', 'DESC')
            ->where('currency', '=', $currency)
            ->first();

        if(!$item)
            return NULL;

        if($item->Rate > 1) {
            $result = $amount / $item->Rate;
        }else{
            $result = $amount * $item->Rate;
        }


        return $result;

    }

    public function saveExchange($data){

        if(!count($data))
            return NULL;

        foreach($data as $item) {

            $new = (new Exchange);

            $new->fill($item);

            $new->save();

        }

    }


}