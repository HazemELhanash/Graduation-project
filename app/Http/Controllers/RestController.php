<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Rest;
use App\Models\User;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;



class RestController extends baseController
{


    public function startRest($id)
    {
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
            $ship = Rest::create(
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

        //=====================================
       /* if($shipments == null){

            Alert::error('Failed', 'عذرا انت لست في رحلة الان ');
            return redirect()->route("driverpage");

        }else{

                   $accurate_shipment = $shipments;




          $rest = Rest::create(
              [
                  'driver_id' => $id,
                  'start_at' => now(),
                  'shipment_number' => $accurate_shipment->id,
              ]
          );

          Alert::success('Success','لقد تم توصيل الرسالة بنجاح ');
          return redirect(route('driverpage'));

        }*/

        }






    public function endRest($id)
    {
        $rest = Rest::find($id);
        $rest->end_at = now();
        $rest->save();
        return redirect(route('driverpage'));
    }


}



