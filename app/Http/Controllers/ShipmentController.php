<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\shipmentResource as shipmentResource;
use App\Http\Controllers\baseController as baseController;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Trunk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class ShipmentController extends baseController
{
    public function index(Request $request)
    {
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Shipment::paginate(5);
        // $data = Shipment::onlyTrashed()->latest()->paginate(5);
        // dd($data);
        // dd($data);
        if($from != null & $to != null)
        {
        $data = Shipment::whereBetween('created_at', [$from, $to])->paginate(5);
        }

        $orders = [];
        foreach ($data as $da) {
            $order = $da->order()->first();
            array_push($orders,$order);
        }
        // dd($orders);
        return view('shipment.index',compact('data','orders','from','to'))->with(request()->input('page'));

    }


    public function store(Request $request)
    {
        //
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

            return  view("shipment.show" , compact('data'));
    }

    #===============================Routes for heba ======================

    public function edit(Shipment $shipment)
    {
        $u=User::find(Auth::id());
        $role=$u->role;
        $client=Customer::all();
        $driver=Driver::all();
        $trunk=Trunk::all();
        $car=Car::all();
        // dd($client);
        if($role == 3 ){
            return view('goda.edit', compact('shipment','client','driver','trunk','car'));
        }else{
            return view('shipment.edit', compact('shipment','client','driver','trunk','car'));
        }

    }

    public function update(Request $request, Shipment $shipment)
    {
        $input=$request->all();
        $validator=Validator::make($input,[

            'elkaam'=>'required',
            'empty' => 'required',
            'counter_begin' => 'required',
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
            session()->flash('Error', "Something went wrong please try again" );
            return redirect()->back();
        }


        $shipment->elkaam=$input['elkaam'];
        $shipment->empty=$input['empty'];
        $shipment->rest= ($input['elkaam'] - $input["empty"]);
        // $shipment->car_code=$input['car_code'];
        // $shipment->trunk_code=$input['trunk_code'];
        // $shipment->client_name=$input['client_name'];
        // $shipment->driver_name=$input['driver_name'];


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
        $nawloon_value=$order->nawloon_value;
        $shipment->incoming_value = ($shipment->rest * $nawloon_value );

        //==============End

        //calculation for Taxes
        $shipment->taxes = ($shipment->incoming_value * 0.14 );

        //==============End





         // to calculate upgrade in original quantity


        $order_quantity=($order->quantity - $shipment->rest );

        if($order_quantity <= 0 ){
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

        $u=User::find(Auth::id());
        $role=$u->role;
        if($role == 3 ){
            return redirect()->route('supervisors.index');
        }else{
            return redirect()->route('shipments.index');
        }


    }

# ===================================End=========================



    // public function destroy(Shipment $id)
    // {
    //     //delete the product
    //     $shipment=Shipment::find($id);
    //     if($shipment==NULL){
    //         return redirect()->route('shipments.index');
    //     }
    //     $shipment->delete();
    //     //redirect the user
    //     Alert::success('success','You delete successfully');
    //     return back();

    // }

    public function trashshipment(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Shipment::paginate(5);

        if($from != null & $to != null)
        {
        $data = Shipment::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        $data = Shipment::onlyTrashed()->latest()->paginate(5);
        return view('shipment.trash',compact('data','from','to'));

    }

    public function destroy(Shipment $shipment)
    {
        $shipment -> delete();
       // return redirect()->route('shipments.index')->with('success','shipment deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('shipments.index');
    }
    public function softDelete($id)
    {
        $shipment = Shipment::find($id)->delete();//علشان يدور ب الid

       // return redirect()->route('shipments.index')->with('success','shipment deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('shipments.index');
    }
    public function deleteForEver($id)
    {
        $shipment = Shipment::onlyTrashed()->where('id',$id)->forceDelete();

       // return redirect()->route('shipments.trash')->with('success','shipment deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('shipments.index');
    }
    public function backFromSoftDelete($id)
    {
        $shipment = Shipment::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('shipments.index')->with('success','shipment back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('shipments.index');
    }



}
