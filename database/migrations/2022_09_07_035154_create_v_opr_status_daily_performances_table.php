<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVOprStatusDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `v_opr_status_daily_performances` AS
            SELECT
                `opr_daily_performances`.`id` AS `id`,
                `opr_daily_performances`.`inbound_date` AS `inbound_date`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 1 DAY) >= `opr_daily_performances`.`date_0`) AS `islate_d0`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 2 DAY) >= `opr_daily_performances`.`date_1`) AS `islate_d1`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 3 DAY) >= `opr_daily_performances`.`date_2`) AS `islate_d2`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 4 DAY) >= `opr_daily_performances`.`date_3`) AS `islate_d3`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 5 DAY) >= `opr_daily_performances`.`date_4`) AS `islate_d4`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 6 DAY) >= `opr_daily_performances`.`date_5`) AS `islate_d5`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 7 DAY) >= `opr_daily_performances`.`date_6`) AS `islate_d6`,
                ((`opr_daily_performances`.`inbound_date` + INTERVAL 8 DAY) >= `opr_daily_performances`.`date_7`) AS `islate_d7`,
                (CASE
                    WHEN (`opr_daily_performances`.`date_8` IS NOT NULL) THEN 1
                    ELSE NULL
                END) AS `islate_d8`
            FROM
                `opr_daily_performances`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_opr_status_daily_performances');
    }
}
