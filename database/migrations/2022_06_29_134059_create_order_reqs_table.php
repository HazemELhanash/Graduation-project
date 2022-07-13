<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_reqs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone_1");
            $table->string("phone_2");
            $table->string("email");
            $table->string("adress");
            $table->string("product_type");
            $table->double("quantity");
            $table->longText("details");
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_reqs');
    }
}
