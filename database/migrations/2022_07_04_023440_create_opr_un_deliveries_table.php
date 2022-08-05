<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprUnDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opr_un_deliveries', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('no_awb', 255)->nullable();
            $table->string('hub', 255)->nullable();
            $table->string('origin', 255)->nullable();
            $table->integer('shipper')->nullable();
            $table->string('consignee', 255)->nullable();
            $table->string('consignee_addr', 1000)->nullable();
            $table->string('phone', 1000)->nullable();
            $table->string('goods_desc', 1000)->nullable();
            $table->string('undel_code', 1000)->nullable();
            $table->string('undel_desc', 1000)->nullable();
            $table->date('date_inbound')->nullable();
            $table->integer('opr_customer_account_id')->nullable();
            $table->integer('sla')->nullable();
            $table->date('date_return')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('opr_un_deliveries');
    }
}
