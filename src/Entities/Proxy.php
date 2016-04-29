<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proxy extends Model {

    protected $fillable = ['ip'];

    protected $table = 'reg2005_proxys';

    public function get_proxy()
    {
        $item = $this
            ->orderBy('last_use', 'asc')
            ->where('active', '=', true)
            ->first();

        if ($item) {

            $item->last_use = Carbon::now();

            $item->save();

            return $item->ip;

        }

        return NULL;
    }
}