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
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class OrderController extends baseController
{

    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Order::paginate(5);

        if($from != null & $to != null)
        {
        $data = Order::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('order.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Order::latest()->paginate(5);
        // return view('order.index' , compact('data'))->with(request()->input('page')) ;
    }

    public function create()
    {
        return view('order.create');
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
            Alert::error('Failed', 'Please, Check your data again');
            return back();
        }else{

            // First creat product to get its id
            $product_data=$request->only("type","option");
            $product= Product::create($product_data);

        
        $order = Order::create(
            [
                'nawloon' => $request-> nawloon,
                'nawloon_value' => $request-> nawloon_value,
                'quantity' => $request-> quantity,
                'driver_money' => $request-> driver_money,
                'user_id' => $request-> user_id,
                'product_id' => $product->id,
            ]
        );
       // ===== من اول هنا هنبدأ نملي الداتا بتاعتنا اللي بتعتمد علي الاوردر اي دي

        // $product_data["order_id"]=$order->id;

        //information to shipment
        $shipment_data=$request->only("load_place","offload_place");
        $shipment_data["order_id"]=$order->id;
        $shipment_data["product_id"]=$product->id;
        $shipment=Shipment::create($shipment_data);


       /* session()->flash('Done', "Order created successfully" );
           return redirect("");*/

           Alert::success('Success', 'We will contact you' );
           return redirect()->route('orders.index');
        }
    }


    public function show($id)
    {
        $order=Order::find($id);
        if(is_null($order)){
            Alert::error('Failed', 'Please, Check your connection');
            return back();
        }

       /* $shipment = Shipment::where('order_id', $id)->get(['load_place' , ]);
                $shipment= DB::table('shipments')->select('offload_place')->where('order_id', $id);
        $product['type']= DB::table('products')->select('type')->where('order_id', $id);
        $product['option']= DB::table('products')->select('option')->where('order_id', $id);
        $data=[$order->nawloon, $order->nawloon_value, $order->quantity,
               $order->driver_money , $order->user_id , $shipment['load_place'],
               $shipment['offload_place'], $product['type'] , $product['option'],
               $order->created_at , $order->updated_at];*/
            // $prod = Product::find($order->prod)
            $data=$order;
            $product= $order->product()->first();
            // $shipment = $order->shipment()->get();
            // dd($shipment);
            // dd($product->type);

             return  view("order.show" , compact('data'));
    }


    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
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
            Alert::error('Error', ' Order Can not be updated' );
              return redirect()->back();
        }

        $order->nawloon=$input['nawloon'];
        $order->nawloon_value=$input['nawloon_value'];
        $order->quantity=$input['quantity'];
        $order->driver_money=$input['driver_money'];
        $order->user_id=$input['user_id'];
        $order->save();


        Alert::success('Success', ' Order updated successfully ' );
           return redirect()->route('orders.index');
    }


    /*
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->sendResponse(new orderResource($order),'order deleted successufully');
    }
    */

    // public function destroy($id)
    // {
    //     //delete the product
    //     $order=Order::find($id);
    //     if($order==NULL){
    //         return redirect()->route('orders');
    //     }
    //     $order->delete();
    //     //redirect the user
    //     Alert::success('success','You delete successfully');
    //     return back();
    // }
    public function trashorder(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Order::paginate(5);

        if($from != null & $to != null)
        {
        $data = Order::whereBetween('created_at', [$from, $to])->paginate(5);
        }

        $data = Order::onlyTrashed()->latest()->paginate(5);
        return view('order.trash',compact('data','from','to'));

    }
    public function destroy(Order $order)
    {
        $order -> delete();
        //return redirect()->route('orders.index')->with('success','order deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('orders.index');
    }
    public function softDelete($id)
    {
        $order = Order::find($id)->delete();//علشان يدور ب الid

       // return redirect()->route('orders.index')->with('success','driver deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('orders.index');
    }
    public function deleteForEver($id)
    {
        $order = Order::onlyTrashed()->where('id',$id)->forceDelete();

        //return redirect()->route('orders.trash')->with('success','order deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('orders.index');
    }
    public function backFromSoftDelete($id)
    {
        $order = Order::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('orders.index')->with('success','order back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('orders.index');

    }

    //==== REport for order = == = = = = = = = = = = = =  = =
    public function orderReport(){
        $order=Order::all();
        return redirect()->route("reporting" , compact("order"));

    }
    //============End=======================


}
