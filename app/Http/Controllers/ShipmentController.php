<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\shipmentResource as shipmentResource;
use App\Http\Controllers\baseController as baseController;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class ShipmentController extends baseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Shipment::all();
        return $this->sendResponse(shipmentResource::collection($data) , "all data retrived successfully");

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $shipment=Shipment::find($id);
        if(is_null($shipment)){
            return $this->sendError('shipment not found');
        }
        return $this->sendResponse(new shipmentResource($shipment),'shipment is found');
    }


    public function update(Request $request, Shipment $shipment)
    {
        $input=$request->all();
        $validator=Validator::make($input,[

            'elkaam'=>'required',
            'empty' => 'required',
           // 'rest' => 'required',
            'car_code'=>'required',
            'trunk_code'=>'required',
            'client_name'=>'required',
            'driver_name' => 'required',
            'counter_begin' => 'required',
            'counter_end'=>'required',
           // 'kilometers_per_trip'=>'required',
            'distnation'=>'required',
            'policy_number' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }


        $shipment->elkaam=$input['elkaam'];
        $shipment->empty=$input['empty'];
        $shipment->rest= ($input['elkaam'] - $input["empty"]);
        $shipment->car_code=$input['car_code'];
        $shipment->trunk_code=$input['trunk_code'];
        $shipment->client_name=$input['client_name'];
        $shipment->driver_name=$input['driver_name'];
        $shipment->counter_begin=$input['counter_begin'];
        $shipment->counter_end=$input['counter_end'];
        if($input['counter_end'] == 0){
            $shipment->kilometers_per_trip=0;
        }else{
            $shipment->kilometers_per_trip=($shipment->counter_end - $shipment->counter_begin );
        }

        $shipment->distnation=$input['distnation'];
        $shipment->policy_number=$input['policy_number'];

        //calculation for incoming_value
        $id= $shipment["order_id"];
        $order=Order::find($id);
        $nawloon_value=$order->nawloon_value;
        $shipment->incoming_value = ($shipment->rest * $nawloon_value );

        //==============End

        //calculation for Taxes
        $shipment->taxes = ($shipment->incoming_value * 0.14 );

        //==============End





         // to calculate upgrade in original quantity


        $order_quantity=($order->quantity - $shipment->rest );

        if($order_quantity==0){
            $order->quantity=0;
        }else{
            $order->quantity= $order_quantity;
        }


        DB::table('orders')
        ->where('id', $id)
        ->update(['quantity' => $order->quantity]);
        // =============== End ===============


        $shipment->save();
        return $this->sendResponse(new shipmentResource($shipment),'shipment updated successufully');

    }


    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return $this->sendResponse(new shipmentResource($shipment),'shipment deleted successufully');

    }
}
