<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\orderResource as orderResource;
use App\Http\Controllers\baseController as baseController;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\Trunk;
use Illuminate\Support\Facades\DB;


class OrderController extends baseController
{

    public function index()
    {
        $data=Order::all();
        return $this->sendResponse(orderResource::collection($data) , "all data retrived successfully");
    }

    public function store(Request $request)
    {
        $input=$request->all();

        $validator=Validator::make($input,[
            'nawloon'=>'required',
            'nawloon_value'=>'required',
            'quantity'=>'required',
            'driver_money' => 'required',
            'user_id' => 'required',
            'type' => 'required',
            'option' => 'required',
            'load_place' => 'required',
            'offload_place' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }

        $order_data=$request->only("nawloon" , "nawloon_value","quantity","driver_money","user_id");
        $order=Order::create($order_data);
       // ===== من اول هنا هنبدأ نملي الداتا بتاعتنا اللي بتعتمد علي الاوردر اي دي

        $product_data=$request->only("type","option");
        $product_data["order_id"]=$order->id;
         $product= Product::create($product_data);

        //information to shipment
        $shipment_data=$request->only("load_place","offload_place");
        $shipment_data["order_id"]=$order->id;
        $shipment_data["product_id"]=$product->id;
        $shipment=Shipment::create($shipment_data);


        return $this->sendResponse(new orderResource($order),'order created successufully');
    }


    public function show($id)
    {
        $order=Order::find($id);
        if(is_null($order)){
            return $this->sendError('order not found');
        }
        return $this->sendResponse(new orderResource($order),'order is found');
    }


    public function update(Request $request, Order $order)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nawloon'=>'required',
            'nawloon_value'=>'required',
            'quantity'=>'required',
            'driver_money' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $order->nawloon=$input['nawloon'];
        $order->nawloon_value=$input['nawloon_value'];
        $order->quantity=$input['quantity'];
        $order->driver_money=$input['driver_money'];
        $order->user_id=$input['user_id'];
        $order->save();
        return $this->sendResponse(new orderResource($order),'order updated successufully');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return $this->sendResponse(new orderResource($order),'order deleted successufully');
    }
}
