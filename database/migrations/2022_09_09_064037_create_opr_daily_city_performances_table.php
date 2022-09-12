<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprDailyCityPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //  delete it after migrate
    public function up()
    {
        Schema::create('opr_daily_city_performances', function (Blueprint $table) {
            $table->id();
            $table->date('inbound_date')->nullable();
            $table->string('zone', 255)->nullable();
            $table->string('hub', 255)->nullable();
            $table->integer('total_shipment_cod')->nullable();
            $table->integer('total_nominal_cod')->nullable();

            $table->date('date_0')->nullable();
            $table->integer('total_0')->nullable();
            $table->integer('unrunsheet_0')->nullable();
            $table->integer('delivered_0')->nullable();
            $table->integer('cr_0')->nullable();
            $table->integer('undel_0')->nullable();
            $table->integer('open_0')->nullable();
            $table->integer('return_0')->nullable();
            $table->integer('wh_0')->nullable();
            $table->integer('successreturn_0')->nullable();

            $table->date('date_1')->nullable();
            $table->integer('total_1')->nullable();
            $table->integer('unrunsheet_1')->nullable();
            $table->integer('delivered_1')->nullable();
            $table->integer('cr_1')->nullable();
            $table->integer('undel_1')->nullable();
            $table->integer('open_1')->nullable();
            $table->integer('return_1')->nullable();
            $table->integer('wh_1')->nullable();
            $table->integer('successreturn_1')->nullable();

            $table->date('date_2')->nullable();
            $table->integer('total_2')->nullable();
            $table->integer('unrunsheet_2')->nullable();
            $table->integer('delivered_2')->nullable();
            $table->integer('cr_2')->nullable();
            $table->integer('undel_2')->nullable();
            $table->integer('open_2')->nullable();
            $table->integer('return_2')->nullable();
            $table->integer('wh_2')->nullable();
            $table->integer('successreturn_2')->nullable();

            $table->integer('closed')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opr_daily_city_performances');
    }
}
