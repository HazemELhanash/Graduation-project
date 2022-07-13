<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\customerResource as customerResource;
use App\Http\Controllers\baseController as baseController;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerController extends baseController
{
    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Customer::paginate(5);

        if($from != null & $to != null)
        {
        $data = Customer::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('customer.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Customer::latest()->paginate(5);
        // return view('customer.index', compact('data'))->with(request()->input('page'));

    }
    public function create(){
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);
        if($validator->fails()){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }else{
        $customer=Customer::create($input);
        Alert::success('success','You have successed');
        return redirect()->route('customers.index');
        }
    }

    public function show($id)
    {
        $customer=Customer::find($id);
        if(is_null($customer)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        return view('customer.show',compact('customer'));

    }

    public function edit(Customer $customer){
        return view('customer.edit',compact('customer'));
    }


    public function update(Request $request, Customer $customer)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);

        if($validator->fails()){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }

        $customer->name=$input['name'];
        $customer->phone=$input['phone'];
        $customer->address=$input['address'];
        $customer->save();
        Alert::success('success','You have successed');
        return redirect()->route('customers.index');

    }


    // public function destroy($id)
    // {
    //     $customer=Customer::find($id);
    //     if($customer == NULL){
    //         return redirect()->route('customers.index');
    //     }
    //     $customer->delete();
    //     Alert::success('success','You delete successfully');
    //     return back();

    // }
    public function trashcustomer(Request $request)
    {
        // dd('arrive to controller');

        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Customer::paginate(5);

        if($from != null & $to != null)
        {
        $data = Customer::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        $data = Customer::onlyTrashed()->latest()->paginate(5);
        return view('customer.trash',compact('data','from','to'));

    }
    public function destroy(Customer $customer)
    {
        $customer -> delete();
        //return redirect()->route('customers.index')->with('success','customer deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('customers.index');
    }
    public function softDelete($id)
    {
        $customer = Customer::find($id)->delete();//علشان يدور ب الid

        //return redirect()->route('customers.index')->with('success','customer deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('customers.index');
    }
    public function deleteForEver($id)
    {
        $customer = Customer::onlyTrashed()->where('id',$id)->forceDelete();

        //return redirect()->route('customers.trash')->with('success','customer deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('customers.index');
    }
    public function backFromSoftDelete($id)
    {
        $customer = Customer::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('customers.index')->with('success','customer back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('customers.index');

    }
}
