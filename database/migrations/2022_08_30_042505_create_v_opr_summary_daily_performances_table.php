<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVOprSummaryDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `v_opr_summary_daily_performances` AS
        SELECT
            `opr_daily_performances`.`inbound_date` AS `inbound_date`,
            `opr_daily_performances`.`zone` AS `zone`,
            SUM(`opr_daily_performances`.`total_shipment_cod`) AS `total_shipment_cod`,
            SUM(`opr_daily_performances`.`total_nominal_cod`) AS `total_nominal_cod`,
            SUM(`opr_daily_performances`.`total_0`) AS `total_0`,
            SUM(`opr_daily_performances`.`unrunsheet_0`) AS `unrunsheet_0`,
            SUM(`opr_daily_performances`.`delivered_0`) AS `delivered_0`,
            SUM(`opr_daily_performances`.`successreturn_0`) AS `successreturn_0`,
            SUM(`opr_daily_performances`.`cr_0`) AS `cr_0`,
            SUM(`opr_daily_performances`.`undel_0`) AS `undel_0`,
            SUM(`opr_daily_performances`.`open_0`) AS `open_0`,
            SUM(`opr_daily_performances`.`return_0`) AS `return_0`,
            SUM(`opr_daily_performances`.`wh_0`) AS `wh_0`,
            SUM(`opr_daily_performances`.`total_1`) AS `total_1`,
            SUM(`opr_daily_performances`.`unrunsheet_1`) AS `unrunsheet_1`,
            SUM(`opr_daily_performances`.`delivered_1`) AS `delivered_1`,
            SUM(`opr_daily_performances`.`successreturn_1`) AS `successreturn_1`,
            SUM(`opr_daily_performances`.`cr_1`) AS `cr_1`,
            SUM(`opr_daily_performances`.`undel_1`) AS `undel_1`,
            SUM(`opr_daily_performances`.`open_1`) AS `open_1`,
            SUM(`opr_daily_performances`.`return_1`) AS `return_1`,
            SUM(`opr_daily_performances`.`wh_1`) AS `wh_1`,
            SUM(`opr_daily_performances`.`total_2`) AS `total_2`,
            SUM(`opr_daily_performances`.`unrunsheet_2`) AS `unrunsheet_2`,
            SUM(`opr_daily_performances`.`delivered_2`) AS `delivered_2`,
            SUM(`opr_daily_performances`.`successreturn_2`) AS `successreturn_2`,
            SUM(`opr_daily_performances`.`cr_2`) AS `cr_2`,
            SUM(`opr_daily_performances`.`undel_2`) AS `undel_2`,
            SUM(`opr_daily_performances`.`open_2`) AS `open_2`,
            SUM(`opr_daily_performances`.`return_2`) AS `return_2`,
            SUM(`opr_daily_performances`.`wh_2`) AS `wh_2`,
            SUM(`opr_daily_performances`.`total_3`) AS `total_3`,
            SUM(`opr_daily_performances`.`unrunsheet_3`) AS `unrunsheet_3`,
            SUM(`opr_daily_performances`.`delivered_3`) AS `delivered_3`,
            SUM(`opr_daily_performances`.`successreturn_3`) AS `successreturn_3`,
            SUM(`opr_daily_performances`.`cr_3`) AS `cr_3`,
            SUM(`opr_daily_performances`.`undel_3`) AS `undel_3`,
            SUM(`opr_daily_performances`.`open_3`) AS `open_3`,
            SUM(`opr_daily_performances`.`return_3`) AS `return_3`,
            SUM(`opr_daily_performances`.`wh_3`) AS `wh_3`,
            SUM(`opr_daily_performances`.`total_4`) AS `total_4`,
            SUM(`opr_daily_performances`.`unrunsheet_4`) AS `unrunsheet_4`,
            SUM(`opr_daily_performances`.`delivered_4`) AS `delivered_4`,
            SUM(`opr_daily_performances`.`successreturn_4`) AS `successreturn_4`,
            SUM(`opr_daily_performances`.`cr_4`) AS `cr_4`,
            SUM(`opr_daily_performances`.`undel_4`) AS `undel_4`,
            SUM(`opr_daily_performances`.`open_4`) AS `open_4`,
            SUM(`opr_daily_performances`.`return_4`) AS `return_4`,
            SUM(`opr_daily_performances`.`wh_4`) AS `wh_4`,
            SUM(`opr_daily_performances`.`total_5`) AS `total_5`,
            SUM(`opr_daily_performances`.`unrunsheet_5`) AS `unrunsheet_5`,
            SUM(`opr_daily_performances`.`delivered_5`) AS `delivered_5`,
            SUM(`opr_daily_performances`.`successreturn_5`) AS `successreturn_5`,
            SUM(`opr_daily_performances`.`cr_5`) AS `cr_5`,
            SUM(`opr_daily_performances`.`undel_5`) AS `undel_5`,
            SUM(`opr_daily_performances`.`open_5`) AS `open_5`,
            SUM(`opr_daily_performances`.`return_5`) AS `return_5`,
            SUM(`opr_daily_performances`.`wh_5`) AS `wh_5`,
            SUM(`opr_daily_performances`.`total_6`) AS `total_6`,
            SUM(`opr_daily_performances`.`unrunsheet_6`) AS `unrunsheet_6`,
            SUM(`opr_daily_performances`.`delivered_6`) AS `delivered_6`,
            SUM(`opr_daily_performances`.`successreturn_6`) AS `successreturn_6`,
            SUM(`opr_daily_performances`.`cr_6`) AS `cr_6`,
            SUM(`opr_daily_performances`.`undel_6`) AS `undel_6`,
            SUM(`opr_daily_performances`.`open_6`) AS `open_6`,
            SUM(`opr_daily_performances`.`return_6`) AS `return_6`,
            SUM(`opr_daily_performances`.`wh_6`) AS `wh_6`,
            SUM(`opr_daily_performances`.`total_7`) AS `total_7`,
            SUM(`opr_daily_performances`.`unrunsheet_7`) AS `unrunsheet_7`,
            SUM(`opr_daily_performances`.`delivered_7`) AS `delivered_7`,
            SUM(`opr_daily_performances`.`successreturn_7`) AS `successreturn_7`,
            SUM(`opr_daily_performances`.`cr_7`) AS `cr_7`,
            SUM(`opr_daily_performances`.`undel_7`) AS `undel_7`,
            SUM(`opr_daily_performances`.`open_7`) AS `open_7`,
            SUM(`opr_daily_performances`.`return_7`) AS `return_7`,
            SUM(`opr_daily_performances`.`wh_7`) AS `wh_7`,
            SUM(`opr_daily_performances`.`total_8`) AS `total_8`,
            SUM(`opr_daily_performances`.`unrunsheet_8`) AS `unrunsheet_8`,
            SUM(`opr_daily_performances`.`delivered_8`) AS `delivered_8`,
            SUM(`opr_daily_performances`.`successreturn_8`) AS `successreturn_8`,
            SUM(`opr_daily_performances`.`cr_8`) AS `cr_8`,
            SUM(`opr_daily_performances`.`undel_8`) AS `undel_8`,
            SUM(`opr_daily_performances`.`open_8`) AS `open_8`,
            SUM(`opr_daily_performances`.`return_8`) AS `return_8`,
            SUM(`opr_daily_performances`.`wh_8`) AS `wh_8`
        FROM
            `opr_daily_performances`
        GROUP BY `opr_daily_performances`.`inbound_date` , `opr_daily_performances`.`zone`
        ORDER BY `opr_daily_performances`.`inbound_date` DESC , `opr_daily_performances`.`zone`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_opr_summary_daily_performances');
    }
}
