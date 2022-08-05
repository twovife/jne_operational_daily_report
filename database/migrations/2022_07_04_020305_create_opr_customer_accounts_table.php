<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOprCustomerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opr_customer_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_account');
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_grouping', 255)->nullable();
            $table->integer('cod')->nullable();
            $table->integer('hold')->nullable();
            $table->integer('sla_hold')->nullable();
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
        Schema::dropIfExists('opr_customer_accounts');
    }
}
