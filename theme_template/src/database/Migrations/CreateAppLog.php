<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 06/04/2017
 * Time: 12:11
 */

namespace database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateAppLog extends Migration {
    public function up () {
        if (!Capsule::schema()->hasTable('share_app_log')) {
            Capsule::schema()->create('share_app_log', function (Blueprint $table) {
                $table->increments('id');
                $table->longText('log');
                $table->timestamps();
            });
        }
    }

    public function down () {
        Capsule::schema()->dropIfExists( 'share_app_log');
    }
}
