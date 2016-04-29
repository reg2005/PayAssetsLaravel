<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 29.04.16
 * Time: 19:09
 */
namespace reg2005\PayAssetsLaravel\Lib;

use MarkWilson\XmlToJson\XmlToJsonConverter;
use JJG\Ping;

class ExchangeLib{

    public $host = 'http://query.yahooapis.com/v1/public/',
        $url = 'yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22USDEUR%22,%20%22USDRUB%22,%20%22USDBTC%22,%20%22USDKZT%22,%20%22USDXAU%22)&env=store://datatables.org/alltableswithkeys';

    public function get_all(){

        $xml = file_get_contents($this->host.$this->url);

        $xml = new \SimpleXMLElement($xml);

        $converter = new XmlToJsonConverter();
        $json = json_decode($converter->convert($xml), TRUE);

        if( isset($json['query']['results']['rate']) )
            return $this->clear_array($json['query']['results']['rate']);

        return NULL;
    }

    function every_seconds($sec = 5, $res = [] ){

        $ping = 90000;

        $pinger = new Ping('query.yahooapis.com');

        $latency = $pinger->ping();
        if ($latency !== false) {
            $ping = $latency*1000;
        }

        $time = [
            'start' => time(),

            'sec_in_micro' => 1000000,
            'end' => time() + (60 - $sec),
            'end' => time() + 20,
        ];

        for($i = 0; $time['end'] > time(); $i++){
            $r = $this->clear_array($this->get_all());

            foreach($r as $k2=>$r2){
                $r[$k2]['Time'] = time();
            }


            $this->db->insert_batch('trade_info', $r);

            if($r)
                $res[time()] = $r;

            usleep($sec*($time['sec_in_micro']-$ping*1.2));
        }

        return $res;
    }

    private function clear_array($array = NULL){
        foreach($array as $key=>$it){

            if( isset($it['Name']) )
                $explode = explode('/', $it['Name']);

            if( isset($explode[1]) )
                $it['Currency'] = $explode[1];

            if( isset($it['-id']) )
                $result[ $it['-id'] ] = $it;
        }
        return $result;
    }

}