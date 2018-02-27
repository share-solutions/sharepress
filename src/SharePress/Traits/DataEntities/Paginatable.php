<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 04/04/2017
 * Time: 11:36
 */

namespace share\SharePress\Traits\DataEntities;

trait Paginatable {
    // paginate is already taken inside Eloquent to go through illuminate/Pagination/Paginator,
    // which we didn't include because of php versions available on server
    public function scopePagination($query, $page = null, $pageSize = null) {
        $pdRecruitmentAdminDefaultPageSize = 10;
        $pageSize = $pageSize === null?$pdRecruitmentAdminDefaultPageSize:$pageSize;
        $totalItems = $query->count();
        return [
            'data' => $query
                ->skip(intval($page) * intval($pageSize))
                ->limit(intval($pageSize))
                ->get(),
            'count' => $totalItems,
            'page' => intval($page),
            'pageSize' => intval($pageSize)
        ];
    }
}
