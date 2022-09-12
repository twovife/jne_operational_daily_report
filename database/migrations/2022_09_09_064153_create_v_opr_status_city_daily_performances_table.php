<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVOprStatusCityDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `v_opr_status_city_daily_performances` AS
            SELECT
                `opr_daily_city_performances`.`id` AS `id`,
                `opr_daily_city_performances`.`inbound_date` AS `inbound_date`,
                ((`opr_daily_city_performances`.`inbound_date` + INTERVAL 1 DAY) >= `opr_daily_city_performances`.`date_0`) AS `islate_d0`,
                ((`opr_daily_city_performances`.`inbound_date` + INTERVAL 2 DAY) >= `opr_daily_city_performances`.`date_1`) AS `islate_d1`,
                (CASE
                    WHEN (`opr_daily_city_performances`.`date_2` IS NOT NULL) THEN 1
                    ELSE NULL
                END) AS `islate_d2`
            FROM
                `opr_daily_city_performances`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_opr_status_city_daily_performances');
    }
}
