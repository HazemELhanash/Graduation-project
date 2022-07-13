<?php

namespace App\Http\Controllers;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\shipmentResource as shipmentResource;
use App\Http\Controllers\baseController as baseController;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Trunk;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GodaController extends baseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Shipment::paginate(5);

        if($from != null & $to != null)
        {
        $data = Shipment::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");



        return view('goda.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Shipment::latest()->paginate(5);
        // return view('goda.index' , compact('data'))->with(request()->input('page')) ;
    }



    public function show($id)
    {
        $shipment=Shipment::find($id);
        if(is_null($shipment)){
            Alert::error('Failed', 'Please, Check your connection');
            return back();
        }

        $data=$shipment;
        $car= $shipment->car()->first();
        $driver= $shipment->driver()->first();
        $trunk= $shipment->trunk()->first();
        $client= $shipment->customer()->first();
             return  view("goda.show" , compact('data'));
    }


    public function edit(Shipment $shipment)
    {
        $client=Customer::all();
        $driver=Driver::all();
        $trunk=Trunk::all();
        $car=Car::all();
        return view('goda.edit', compact('shipment','client','driver','trunk','car'));
    }


    public function update(Request $request, Shipment $shipment)
    {
        $input=$request->all();
        $validator=Validator::make($input,[

            'elkaam'=>'required',
            'empty' => 'required',
            'counter_end'=>'required',
            'distnation'=>'required',
            'policy_number' => 'required',
            'status' => 'required',
            'driver_id'=>'required',
            'car_id'=>'required',
            'client_id'=>'required',
            'trunk_id'=>'required',


        ]);

        if($validator->fails()){
            Alert::error('Error', ' Data Not updated ' );
            return redirect()->back();
        }


        $shipment->elkaam=$input['elkaam'];
        $shipment->empty=$input['empty'];
        $shipment->rest= ($input['elkaam'] - $input["empty"]);

        $shipment->counter_begin=$input['counter_begin'];
        $shipment->counter_end=$input['counter_end'];
        $shipment->status=$input['status'];
        $shipment->driver_id=$input['driver_id'];
        $shipment->car_id=$input['car_id'];
        $shipment->client_id=$input['client_id'];
        $shipment->trunk_id=$input['trunk_id'];

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
        dd($order);
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
        Alert::success('Success', ' Order updated successfully ' );
           return redirect()->route('supervisors.index');

    }


    public function addMore($id){
        $shipment=Shipment::find($id);
        $data=$shipment->only("load_place","offload_place" , "order_id" , "product_id");
        $done=Shipment::create($data);

        Alert::success('success','You Add one more successfully');
        return redirect()->route('supervisors.index');

    }



}
