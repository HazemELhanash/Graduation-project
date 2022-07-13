<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\driverResource as driverResource;
use App\Http\Controllers\baseController as baseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;



class DriverController extends baseController
{

    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Driver::paginate(5);

        if($from != null & $to != null)
        {
        $data = Driver::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");
        return view('driver.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Driver::latest()->paginate(5);
        // return view('driver.index', compact('data'))->with(request()->input('page'));
    }
    public function create(){
        return view('driver.create');
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
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }else{
            $driver=Driver::create($input);
            Alert::success('success','You have successed');
            return redirect()->route('drivers.index');
        }

    }


    public function show($id)
    {
        $driver=Driver::find($id);
        // dd($driver->rests()->get());
        if(is_null($driver)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        $data = $driver->supplys()->whereMonth('created_at', Carbon::now()->month)->get();
        // dd($data);
        $data1 = $driver->rests()->whereMonth('created_at', Carbon::now()->month)->get();
        $data2 = $driver->ships()->whereMonth('created_at', Carbon::now()->month)->get();
        $supp = $driver->supplys()->whereMonth('created_at', Carbon::now()->month)->get();
        $total_cost = 0;
        foreach ($supp  as $s) {
            $total_cost = $s->cost_box + $total_cost;
        }
        // dd($total_cost);
        return view('driver.show',compact('driver','data','total_cost','data1','data2'));
    }


    public function edit(Driver $driver){
        return view('driver.edit',compact('driver'));
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
            return Alert::error('Failed', 'Please, check your data again');

        }

        $driver->name=$input['name'];
        $driver->phone=$input['phone'];
        $driver->address=$input['address'];
        $driver->money=$input['money'];
        $driver->save();
        Alert::success('success','You have successed');
        return redirect()->route('drivers.index');

    }


    // public function destroy( $id)
    // {
    //     $driver=Driver::find($id);
    //     if($driver==NULL){
    //         return redirect()->route('drivers.index');
    //     }
    //     $driver->delete();
    //     Alert::success('success','You delete successfully');
    //     return back();

    // }
    public function trashdriver(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Driver::paginate(5);

        if($from != null & $to != null)
        {
        $data = Driver::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        $data = Driver::onlyTrashed()->latest()->paginate(5);
        return view('driver.trash',compact('data','from','to'));

    }
    public function destroy(Driver $driver)
    {
        $driver -> delete();
       // return redirect()->route('drivers.index')->with('success','driver deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('drivers.index');
    }
    public function softDelete($id)
    {
        $driver = Driver::find($id)->delete();//علشان يدور ب الid

        //return redirect()->route('drivers.index')->with('success','driver deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('drivers.index');
    }
    public function deleteForEver($id)
    {
        $driver = Driver::onlyTrashed()->where('id',$id)->forceDelete();

        //return redirect()->route('drivers.trash')->with('success','driver deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('drivers.index');
    }
    public function backFromSoftDelete($id)
    {
        $driver = Driver::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('drivers.index')->with('success','driver back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('drivers.index');
    }


    // public function updateSupply($id)
    // {
    //     $user=User::find(Auth::id());
    //     $driver= DB::table('drivers')->where('name', $user->name)->first();
    //     $data=$driver->supply;
    //     if($data == 0){
    //         DB::table('drivers')->where('name', $user->name)->update(['supply' => 1]);

    //     }else{
    //         DB::table('drivers')->where('name', $user->name)->update(['supply' => 0]);

    //     }
    //     Alert::success('العملية ناجحة','لقد تم توصيل الرسالة');
    //     return redirect()->route('driverpage');

    // }

    // public function updateRest($id)
    // {
    //     $user=User::find(Auth::id());
    //     $driver= DB::table('drivers')->where('name', $user->name)->first();
    //     $data=$driver->rest;
    //     if($data == 0){
    //         DB::table('drivers')->where('name', $user->name)->update(['rest' => 1]);

    //     }else{
    //         DB::table('drivers')->where('name', $user->name)->update(['rest' => 0]);

    //     }
    //     Alert::success('العملية ناجحة','لقد تم توصيل الرسالة');
    //     return redirect()->route('driverpage');

    // }

    // public function updateShipment($id)
    // {
    //     $user=User::find(Auth::id());
    //     $driver= DB::table('drivers')->where('name', $user->name)->first();
    //     $data=$driver->shipment;
    //     if($data == 0){
    //         DB::table('drivers')->where('name', $user->name)->update(['shipment' => 1]);

    //     }else{
    //         DB::table('drivers')->where('name', $user->name)->update(['shipment' => 0]);

    //     }
    //     Alert::success('العملية ناجحة','لقد تم توصيل الرسالة');
    //     return redirect()->route('driverpage');

    // }


    public function report($id)
    {
        $driver = Driver::find($id);

        return view('driver.report' , compact('driver'));
    }

    public function getRests($id)
    {
        $driver = Driver::find($id);

        return view('driver.rests' , compact('driver'));
    }

    public function getSupplys($id)
    {
        $driver = Driver::find($id);

        return view('driver.supplys' , compact('driver'));
    }

    public function getShips($id)
    {
        $driver = Driver::find($id);

        return view('driver.ships' , compact('driver'));
    }
}
