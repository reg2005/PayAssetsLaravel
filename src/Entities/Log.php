<?php namespace reg2005\PayAssetsLaravel\Entities;

use Illuminate\Database\Eloquent\Model;

class log extends Model {

    protected $fillable = [];

    protected $table = 'reg2005_logs';

    public $accType = 'UNKNOWN';

    public function insert($error){

        $log = new Log;

        $log->error = $error;

        $log->type = $this->accType;

        $log->save();
    }

}