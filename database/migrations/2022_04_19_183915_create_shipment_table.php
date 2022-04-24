<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment', function (Blueprint $table) {
            $table->increments("id");
            $table->string("load_place");
            $table->string("offload_place");
            $table->float("elkaam");
            $table->float("empty");
            $table->float("rest");
            $table->string('car_code');
            $table->string('trunk_code');
            $table->string('client_name');
            $table->string('driver_name');
            $table->float("counter_begin");
            $table->float("counter_end");
            $table->float("kilometers_per_trip");
                        //جهة الحساب
            $table->string("distnation");
            $table->integer("policy_number");
            $table->double("incoming_value");
            $table->double("taxes");

            //$table->foreignId("order_id")->constrained("orders")->onDelete("cascade");
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

             //$table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            //$table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

           // $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

            //$table->foreign('trunk_id')->references('id')->on('trunks')->onDelete('cascade');

            //$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

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
        Schema::dropIfExists('shipment');
    }
}
