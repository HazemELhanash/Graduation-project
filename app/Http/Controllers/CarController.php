<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\carResource as carResource;
use App\Http\Controllers\baseController as baseController;

class CarController extends baseController
{

    public function index()
    {
        $data=Car::all();
        return $this->sendResponse(carResource::collection($data) , "all data retrived successfully");

    }

    public function store(Request $request)
    {
        $input=$request->only('car_number','car_code');
        $validator=Validator::make($input,[
            'car_number' => 'required',
            'car_code'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $car=Car::create($input);
        return $this->sendResponse(new carResource($car),'car created successufully');

    }


    public function show( $id)
    {
        $car=Car::find($id);
        if(is_null($car)){
            return $this->sendError('car not found');
        }
        return $this->sendResponse(new carResource($car),'car is found');

    }


    public function update(Request $request, Car $car)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            "car_number"=>"required",
            "car_code"=>"required"
        ]);
        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $car->car_number=$input['car_number'];
        $car->car_code=$input['car_code'];
        $car->save();
        return $this->sendResponse(new carResource($car),'car updated successufully');

    }


    public function destroy(Car $car)
    {
        $car->delete();
        return $this->sendResponse(new carResource($car),'car deleted successufully');

    }
}
