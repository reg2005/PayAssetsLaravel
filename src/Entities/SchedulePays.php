<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SchedulePays extends Model {

    protected $fillable = ['amount', 'currency', 'type', 'destination', 'timeout', 'expenditure', 'money_send', 'send_from',

        'send_transfer_id', 'disable', 'error_pay', 'comment', 'send_from_pm_wallet', 'send_to_pm_account_name'];


    protected $table = 'reg2005_schedule_pays';


    public function getUnpayedsScore($type){

        $item = $this
            ->orderBy('timeout', 'asc')
            ->PayType($type)
            ->where('timeout', '<', Carbon::now() )
            ->where('disable', '=', 0)
            ->where('money_send', '=', NULL)
            ->where('count_error_pays', '<', 2)
            ->get();

        return $item;

    }

    public function setTimeout($item)
    {
        if($item) {

            $item->timeout = Carbon::now()->addSeconds(300);

            $item->save();

            return TRUE;
        }
    }

    public function postPayInfoUpdate( $schedule, $transaction = NULL, $accountLogin = NULL, $payWalletId = NULL){

        if($transaction){

            $schedule->money_send = Carbon::now();
            $schedule->send_from_account = $accountLogin;
            $schedule->send_from_pm_wallet = $payWalletId;
            $schedule->send_transfer_id = $transaction;

        }elseif($accountLogin){

            //Проверка на существование аккаунта
            $schedule->count_error_pays = $schedule->count_error_pays+1;

        }

        $schedule->save();

        return TRUE;
    }

   public function scopePayType($query, $type){

       return $query->where('type', '=', $type);

   }

}