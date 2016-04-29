<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exchange extends Model {

    protected $fillable = ['Name', 'Rate', 'Ask', 'Bid', '-id'];

    protected $table = 'reg2005_exchanges';

    public function getLastExchanges(){

        $item = $this
            ->orderBy('updated_at', 'DESC')
            ->first();

        return $item;

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