<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\clientResource as clientResource;
use App\Http\Controllers\baseController as baseController;

class ClientController extends baseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Client::all();
        return $this->sendResponse(clientResource::collection($data) , "all data retrived successfully");

    }

    public function store(Request $request)
    {
        $input=$request->only("name","phone","address");
        $validator=Validator::make($input,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $client=Client::create($input);
        return $this->sendResponse(new clientResource($client),'client created successufully');

    }


    public function show($id)
    {
        $client=Client::find($id);
        if(is_null($client)){
            return $this->sendError('client not found');
        }
        return $this->sendResponse(new clientResource($client),'client is found');

    }

    public function update(Request $request, Client $client)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $client->name=$input['name'];
        $client->phone=$input['phone'];
        $client->address=$input['address'];
        $client->save();
        return $this->sendResponse(new clientResource($client),'client updated successufully');

    }

    public function destroy(Client $client)
    {
        $client->delete();
        return $this->sendResponse(new clientResource($client),'client deleted successufully');

    }
}
