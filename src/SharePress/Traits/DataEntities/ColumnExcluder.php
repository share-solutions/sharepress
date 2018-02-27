<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 24/04/2017
 * Time: 12:31
 */

namespace share\SharePress\Traits\DataEntities;

trait ColumnExcluder {
    public function scopeExclude($query, $value = []) {
        if (!isset($this->columns)) {
            throw new \Exception("Class must defined 'columns' property");
        }
        return $query->select( array_diff( $this->columns, (array) $value) );
    }
}