<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Ship;
use App\Models\Shipment;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ShipController extends baseController
{
    public function startShip($id)
    {
/*
        $ship = Ship::create(
            [
                'driver_id' => $id,
                'start_at' => now(),
            ]
        );
        return redirect(route('driverpage'));*/
        $shipments=Shipment::all()->where('driver_id', $id);
        $count=0;
        foreach($shipments as $ship){
            if($ship->status == "Active"){
                $count ++ ;
            }
        }

        if($count > 0){
            $ship = Ship::create(
                [
                    'driver_id' => $id,
                    'start_at' => now(),
                ]
            );
            Alert::success('Success','لقد تم توصيل الرسالة بنجاح ');
            return redirect(route('driverpage'));

        }else{
            Alert::error('Error', ' لا يمكنك بدأ نقلة الان انت لم تسجل في اي نقلة ' );
            return redirect()->back();
        }


    }

    public function endShip($id)
    {
        $ship = Ship::find($id);
        $ship->end_at = now();
        $ship->save();

    return redirect(route('driverpage'));
    }
}
