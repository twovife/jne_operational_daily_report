<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprDailyPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opr_daily_performances', function (Blueprint $table) {
            $table->id();
            $table->date('inbound_date')->nullable();
            $table->string('zone', 255)->nullable();
            $table->string('hub', 255)->nullable();
            $table->integer('total_shipment_cod')->nullable();
            $table->integer('total_nominal_cod')->nullable();

            $table->date('date_0')->nullable();
            $table->integer('total_0')->nullable();
            $table->integer('ur_0')->nullable();
            $table->integer('d_0')->nullable();
            $table->integer('cr_0')->nullable();
            $table->integer('u_0')->nullable();
            $table->integer('o_0')->nullable();
            $table->integer('r_0')->nullable();

            $table->date('date_1')->nullable();
            $table->integer('total_1')->nullable();
            $table->integer('ur_1')->nullable();
            $table->integer('d_1')->nullable();
            $table->integer('cr_1')->nullable();
            $table->integer('u_1')->nullable();
            $table->integer('o_1')->nullable();
            $table->integer('r_1')->nullable();

            $table->date('date_2')->nullable();
            $table->integer('total_2')->nullable();
            $table->integer('ur_2')->nullable();
            $table->integer('d_2')->nullable();
            $table->integer('cr_2')->nullable();
            $table->integer('u_2')->nullable();
            $table->integer('o_2')->nullable();
            $table->integer('r_2')->nullable();

            $table->date('date_3')->nullable();
            $table->integer('total_3')->nullable();
            $table->integer('ur_3')->nullable();
            $table->integer('d_3')->nullable();
            $table->integer('cr_3')->nullable();
            $table->integer('u_3')->nullable();
            $table->integer('o_3')->nullable();
            $table->integer('r_3')->nullable();

            $table->date('date_4')->nullable();
            $table->integer('total_4')->nullable();
            $table->integer('ur_4')->nullable();
            $table->integer('d_4')->nullable();
            $table->integer('cr_4')->nullable();
            $table->integer('u_4')->nullable();
            $table->integer('o_4')->nullable();
            $table->integer('r_4')->nullable();

            $table->date('date_5')->nullable();
            $table->integer('total_5')->nullable();
            $table->integer('ur_5')->nullable();
            $table->integer('d_5')->nullable();
            $table->integer('cr_5')->nullable();
            $table->integer('u_5')->nullable();
            $table->integer('o_5')->nullable();
            $table->integer('r_5')->nullable();

            $table->date('date_6')->nullable();
            $table->integer('total_6')->nullable();
            $table->integer('ur_6')->nullable();
            $table->integer('d_6')->nullable();
            $table->integer('cr_6')->nullable();
            $table->integer('u_6')->nullable();
            $table->integer('o_6')->nullable();
            $table->integer('r_6')->nullable();

            $table->date('date_7')->nullable();
            $table->integer('total_7')->nullable();
            $table->integer('ur_7')->nullable();
            $table->integer('d_7')->nullable();
            $table->integer('cr_7')->nullable();
            $table->integer('u_7')->nullable();
            $table->integer('o_7')->nullable();
            $table->integer('r_7')->nullable();


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
        Schema::dropIfExists('opr_daily_performances');
    }
}
