<?php

class helper
{
    function __construct(){
        
    }

    public function generateSignature($reqBody, $timestamp){
        $keynya = $this->config['credential']['Signature_key'];
        $uppercase = strtoupper(trim($reqBody));
        $key_hasil = hash_hmac('sha512', $uppercase.':'.$timestamp, $key);
        return $key_hasil;
    }

    public function bintodec($number)
    {
        $base=1;
        $dec_nr=0;
        $number=explode(",", preg_replace("/(.*),/", "$1", str_replace("1", "1,", str_replace("0", "0,", $number))));
        for($i=1; $i<count($number); $i++) $base=$base*2;
            foreach($number as $key=>$number_bit) {
            if($number_bit==1) {
                $dec_nr+=$base;
                $base=$base/2;
            }
            if($number_bit==0) $base=$base/2;
        }
        return $dec_nr;
    }

    public function dectobin($number)
    {
        $binStr = '';
        while ($number>=1){
            $bin = $number % 2;
            $number = round($number/2, 0, PHP_ROUND_HALF_DOWN);
            $binStr .= $bin;
        }
        $binStr = strrev($binStr);
        return($binStr);
    }
}