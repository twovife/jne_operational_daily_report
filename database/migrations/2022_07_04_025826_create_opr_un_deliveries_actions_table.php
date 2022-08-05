<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprUnDeliveriesActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opr_un_deliveries_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('opr_un_delivery_id')->nullable();
            $table->date('action_date')->nullable();
            $table->string('last_action', 400)->nullable();
            $table->string('follow_up', 400)->nullable();
            $table->string('description', 400)->nullable();
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
        Schema::dropIfExists('opr_un_deliveries_actions');
    }
}
