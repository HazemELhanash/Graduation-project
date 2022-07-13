<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Supply;
use App\Models\Rest;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class SupplyController extends baseController
{
    public function startSupply($id,Request $request)
    {

        // $driver = User::find(Auth::id());
        $driver = Driver::find($id);
       // $shipments = DB::table('shipment')->where('status' , "Active")->where("driver_id" , $driver->id)->first();



       $driver = Driver::find($id);
       //    $shipments = DB::table('shipment')->where('status' , "Active")->where("driver_id" , $driver->id)->first();


           $shipments=Shipment::all()->where('driver_id', $id);
           $count=0;
           foreach($shipments as $ship){
               if($ship->status == "Active"){
                   $count ++ ;
                   $accurate_shipment=$ship;
               }
           }

           if($count > 0){
               $ship = Supply::create(
                   [
                       'driver_id' => $id,
                       'start_at' => now(),
                       'shipment_number' => $accurate_shipment->id,
                   ]
               );
               Alert::success('Success','لقد تم توصيل الرسالة بنجاح ');
               return redirect(route('driverpage'));

           }else{
               Alert::error('Error', ' لا يمكنك بدأ نقلة الان انت لم تسجل في اي نقلة ' );
               return redirect()->back();
           }


    }

    public function endSupply($id,Request $request)
    {
        $supply = Supply::find($id);
        $supply->end_at = now();


        if($request->image_path){

            $file=$request->file('image_path');
            $extention = $file->getClientOriginalExtension();

            $file_name= time(). "." . $extention;
            $file->move('uploads/images/' , $file_name);
            $supply->image_path=$file_name;
        }

        $supply->save();

    return redirect(route('driverpage'));
    }

}

/*
if($request->hasFile('image_path')){

    $file=$request->file('image_path');
    $extention = $file->getClientOriginalExtension();
    $file_name= time().'-'.$extention;
    $file->move('uploads/images/' , $file_name);


   Alert::success('Success','لقد تم توصيل الرسالة بنجاح ');
   return redirect(route('driverpage'));
}
*/
