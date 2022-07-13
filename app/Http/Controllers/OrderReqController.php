<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class OrderReqController extends Controller
{

    public function index(Request $request)
    {
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = orderReq::paginate(5);

        if($from != null & $to != null)
        {
        $data = orderReq::whereBetween('created_at', [$from, $to])->paginate(5);
        }


        return view('orderReq.index',compact('data','from','to'))->with(request()->input('page'));
    }



    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name' => 'required',
            'phone_1' => 'required',
            'phone_2' ,
            'email' => 'required',
            'adress' => 'required',
            'product_type' =>'required',
            'quantity' =>'required',
            'details' => 'required'
        ]);

        if($validator->fails()){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }else{
            $orderReq=orderReq::create($input);
            Alert::success('success','You have successed');
            return redirect()->route('index');
        }
    }


    public function show($id)
    {
        $data=orderReq::find($id);

        if(is_null($data)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        return view("orderReq.show", compact('data'));
    }





    public function trashorderReq(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = orderReq::paginate(5);

        if($from != null & $to != null)
        {
        $data = orderReq::whereBetween('created_at', [$from, $to])->paginate(5);
        }

        $data = orderReq::onlyTrashed()->latest()->paginate(5);
        return view('orderReq.trash',compact('data','from','to'));

    }



    public function softDelete($id)
    {
        $orderReq = orderReq::find($id)->delete();//علشان يدور ب الid

        //return redirect()->route('products.index')->with('success','product deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('orderRequests');
    }


    public function deleteForEver($id)
    {
        $orderReq = orderReq::onlyTrashed()->where('id',$id)->forceDelete();

       // return redirect()->route('products.trash')->with('success','product deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('orderRequests');
    }

    public function backFromSoftDelete($id)
    {
        $orderReq = orderReq::onlyTrashed()->where('id',$id)->first()->restore();
       // return redirect()->route('products.index')->with('success','product back successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('orderRequests');
    }

}
