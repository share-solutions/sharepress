<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 23/03/2017
 * Time: 16:45
 */

namespace prevenir\Business\Models\App;

use Illuminate\Database\Eloquent\Model;
use share\SharePress\Traits\DataEntities\Paginatable;

class Log extends Model {
    use Paginatable;

    protected $table = "share_app_log";
    protected $fillable = [
        'log'
    ];
}