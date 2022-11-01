<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVOprUndelAgingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `v_opr_undel_agings` AS
          SELECT
            `opr_undels`.`id` AS `id`,
            (CASE
                WHEN
                    ((CAST(NOW() AS DATE) > `opr_undels`.`date_return`)
                        AND (`opr_undels`.`status` = 0))
                THEN
                    1
                ELSE 2
            END) AS `validate`
            FROM
                `opr_undels`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_opr_undel_agings');
    }
}
