<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVOprSummaryExpressDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `v_opr_summary_express_daily_performances` AS
        SELECT
            `opr_daily_express_performances`.`inbound_date` AS `inbound_date`,
            `opr_daily_express_performances`.`zone` AS `zone`,
            SUM(`opr_daily_express_performances`.`total_shipment_cod`) AS `total_shipment_cod`,
            SUM(`opr_daily_express_performances`.`total_nominal_cod`) AS `total_nominal_cod`,
            SUM(`opr_daily_express_performances`.`total_0`) AS `total_0`,
            SUM(`opr_daily_express_performances`.`unrunsheet_0`) AS `unrunsheet_0`,
            SUM(`opr_daily_express_performances`.`delivered_0`) AS `delivered_0`,
            SUM(`opr_daily_express_performances`.`successreturn_0`) AS `successreturn_0`,
            SUM(`opr_daily_express_performances`.`cr_0`) AS `cr_0`,
            SUM(`opr_daily_express_performances`.`undel_0`) AS `undel_0`,
            SUM(`opr_daily_express_performances`.`open_0`) AS `open_0`,
            SUM(`opr_daily_express_performances`.`return_0`) AS `return_0`,
            SUM(`opr_daily_express_performances`.`wh_0`) AS `wh_0`,
            SUM(`opr_daily_express_performances`.`total_1`) AS `total_1`,
            SUM(`opr_daily_express_performances`.`unrunsheet_1`) AS `unrunsheet_1`,
            SUM(`opr_daily_express_performances`.`delivered_1`) AS `delivered_1`,
            SUM(`opr_daily_express_performances`.`successreturn_1`) AS `successreturn_1`,
            SUM(`opr_daily_express_performances`.`cr_1`) AS `cr_1`,
            SUM(`opr_daily_express_performances`.`undel_1`) AS `undel_1`,
            SUM(`opr_daily_express_performances`.`open_1`) AS `open_1`,
            SUM(`opr_daily_express_performances`.`return_1`) AS `return_1`,
            SUM(`opr_daily_express_performances`.`wh_1`) AS `wh_1`,
            SUM(`opr_daily_express_performances`.`total_2`) AS `total_2`,
            SUM(`opr_daily_express_performances`.`unrunsheet_2`) AS `unrunsheet_2`,
            SUM(`opr_daily_express_performances`.`delivered_2`) AS `delivered_2`,
            SUM(`opr_daily_express_performances`.`successreturn_2`) AS `successreturn_2`,
            SUM(`opr_daily_express_performances`.`cr_2`) AS `cr_2`,
            SUM(`opr_daily_express_performances`.`undel_2`) AS `undel_2`,
            SUM(`opr_daily_express_performances`.`open_2`) AS `open_2`,
            SUM(`opr_daily_express_performances`.`return_2`) AS `return_2`,
            SUM(`opr_daily_express_performances`.`wh_2`) AS `wh_2`
        FROM
            `opr_daily_express_performances`
        GROUP BY `opr_daily_express_performances`.`inbound_date` , `opr_daily_express_performances`.`zone`
        ORDER BY `opr_daily_express_performances`.`inbound_date` DESC , `opr_daily_express_performances`.`zone`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_opr_summary_express_daily_performances');
    }
}
