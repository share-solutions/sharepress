<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 25/11/15
 * Time: 15:47
 */

namespace share\SharePress\WordPress;

class WPCache {

    public function _get($cache_key, \Closure $setIfNotPresent = null) {
        $ret = wp_cache_get($cache_key);
        if (!$ret && $setIfNotPresent !== null) {
            $ret = $setIfNotPresent();
            $this->_set($cache_key, $ret);
        }
        return $ret;
    }

    public function _set($cache_key, $value) {
        if ($value === null) {
            wp_cache_delete($cache_key);
        } else {
            wp_cache_set($cache_key, $value);
        }
    }
}
