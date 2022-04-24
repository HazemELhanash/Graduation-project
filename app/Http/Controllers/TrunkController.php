<?php

namespace App\Http\Controllers;

use App\Models\Trunk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\trunkResource as trunkResource;
use App\Http\Controllers\baseController as baseController;

class TrunkController extends baseController
{

    public function index()
    {
        $data=Trunk::all();
        return $this->sendResponse(trunkResource::collection($data) , "all data retrived successfully");
    }


    public function store(Request $request)
    {
        $input=$request->only('trunk_code');
        $validator=Validator::make($input,[
            'trunk_code' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }


        $trunk=Trunk::create($input);
        return $this->sendResponse(new trunkResource($trunk),'trunk created successufully');
    }


    public function show( $id)
    {
        $trunk=Trunk::find($id);
        if(is_null($trunk)){
            return $this->sendError('trunk not found');
        }
        return $this->sendResponse(new trunkResource($trunk),'trunk is found');
    }


    public function update(Request $request, Trunk $trunk)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            "trunk_code"=>"required"
        ]);
        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $trunk->trunk_code=$input['trunk_code'];
        $trunk->save();
        return $this->sendResponse(new trunkResource($trunk),'trunk updated successufully');
    }


    public function destroy(Trunk $trunk)
    {
        $trunk->delete();
        return $this->sendResponse(new trunkResource($trunk),'trunk deleted successufully');
    }
}
