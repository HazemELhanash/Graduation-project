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
            $table->string("load_place")->default("");
            $table->string("offload_place")->default("");
            $table->float("elkaam")->default(0);
            $table->float("empty")->default(0);
            $table->float("rest")->default(0);
            // $table->string('car_code')->default("");
            // $table->string('trunk_code')->default("");
            // $table->string('client_name')->default("");
            // $table->string('driver_name')->default("");
            $table->float("counter_begin")->default(0);
            $table->float("counter_end")->default(0);
            $table->float("kilometers_per_trip")->default(0);
                        //جهة الحساب
            $table->string("distnation")->default("");
            $table->integer("policy_number")->default(0);
            $table->double("incoming_value")->default(0);
            $table->double("taxes")->default(0);
            $table->string("status")->default("Active");

            //$table->foreignId("order_id")->constrained("orders")->onDelete("cascade");
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

             //$table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');


            $table->unsignedInteger('trunk_id');
            $table->foreign('trunk_id')->references('id')->on('trunks')->onDelete('cascade');

            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('customers')->onDelete('cascade');


            $table->unsignedInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

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
