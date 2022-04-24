<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\productResource as productResource;
use App\Http\Controllers\baseController as baseController;

class ProductController extends baseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Product::all();
        return $this->sendResponse(productResource::collection($data) , "all data retrived successfully");
    }



    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'type' => 'required',
            "option" => 'required',
            "order_id" => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }


        $product=Product::create($input);
        return $this->sendResponse(new productResource($product),'product created successufully');
    }



    public function show($id)
    {
        $product=product::find($id);
        if(is_null($product)){
            return $this->sendError('product not found');
        }
        return $this->sendResponse(new productResource($product),'product is found');
    }


    public function update(Request $request, Product $product)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'type' => 'required',
            "option" => 'required',
            "order_id" => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }

        $product->type=$input['type'];
        $product->option=$input['option'];
        $product->order_id=$input['order_id'];
        $product->save();
        return $this->sendResponse(new productResource($product),'product updated successufully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse(new productResource($product),'product deleted successufully');
    }
}
