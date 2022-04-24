<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\driverResource as driverResource;
use App\Http\Controllers\baseController as baseController;

class DriverController extends baseController
{

    public function index()
    {
        $data=Driver::all();
        return $this->sendResponse(driverResource::collection($data) , "Drivers retrived successfully");
    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => 'required',
            'phone'=>'required',
            'address' => 'required',
            'money' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $driver=Driver::create($input);
        return $this->sendResponse(new driverResource($driver),'Driver created successufully');
    }


    public function show($id)
    {
        $driver=Driver::find($id);
        if(is_null($driver)){
            return $this->sendError('Driver not found');
        }
        return $this->sendResponse(new driverResource($driver),'Driver is found');
    }


    public function update(Request $request, Driver $driver)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => 'required',
            'phone'=>'required',
            'address' => 'required',
            'money' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }

        $driver->name=$input['name'];
        $driver->phone=$input['phone'];
        $driver->address=$input['address'];
        $driver->money=$input['money'];
        $driver->save();
        return $this->sendResponse(new driverResource($driver),'driver updated successufully');

    }


    public function destroy(Driver $driver)
    {
        $driver->delete();
        return $this->sendResponse(new driverResource($driver),'driver deleted successufully');
    }
}
