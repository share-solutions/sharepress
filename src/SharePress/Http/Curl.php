<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 31/03/2017
 * Time: 16:30
 */

namespace share\SharePress\Http;

class Curl {
    public function post ($url, $data) {
        $ch = curl_init($url);
        $encoded = '';
        // include $data variables.
        foreach ($data as $name => $value) {
            $encoded .= urlencode($name).'='.urlencode($value).'&';
        }
        // chop off last ampersand
        $encoded = substr($encoded, 0, strlen($encoded)-1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function get ($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
