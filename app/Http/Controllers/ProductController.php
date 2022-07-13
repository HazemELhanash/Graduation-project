<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\productResource as productResource;
use App\Http\Controllers\baseController as baseController;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends baseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Product::paginate(15);

        if($from != null & $to != null)
        {
        $data = Product::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('product.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Product::latest()->paginate(5);
        // return view('product.index',compact('data'))->with(request()->input('page'));
    }

    public function create(){
        return view('product.create');
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
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }else{
            $product=Product::create($input);
            Alert::success('success','You have successed');
            return redirect()->route('products.index');
        }

    }

    public function show($id)
    {
        $product=product::find($id);
        if(is_null($product)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        return view('product.show',compact('product'));
    }
    public function edit(Product $product){
        return view('product.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'type' => 'required',
            "option" => 'required',
        ]);

        if($validator->fails()){
            return Alert::error('Failed', 'Please, check your data again');
        }

        $product->type=$input['type'];
        $product->option=$input['option'];
        // $product->order_id=$input['order_id'];
        $product->save();
        Alert::success('success','You have successed');
            return redirect()->route('products.index');
    }


    // public function destroy( $id)
    // {
    //     $product=Product::find($id);
    //     if($product==NULL){
    //         return redirect()->route('products.index');
    //     }
    //     $product->delete();
    //     //redirect the user
    //     Alert::success('success','You delete successfully');
    //     return back();
    // }
    public function destroy(Product $product)
    {
        $product -> delete();
       // return redirect()->route('products.index')->with('success','product deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('products.index');
    }
    public function softDelete($id)
    {
        $product = Product::find($id)->delete();//علشان يدور ب الid

        //return redirect()->route('products.index')->with('success','product deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('products.index');
    }
    public function deleteForEver($id)
    {
        $product = Product::onlyTrashed()->where('id',$id)->forceDelete();

       // return redirect()->route('products.trash')->with('success','product deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('products.index');
    }
    public function backFromSoftDelete($id)
    {
        $product = Product::onlyTrashed()->where('id',$id)->first()->restore();
       // return redirect()->route('products.index')->with('success','product back successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('products.index');
    }
}
