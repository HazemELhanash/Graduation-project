<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\carResource as carResource;
use App\Http\Controllers\baseController as baseController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class CarController extends baseController
{

    public function index(Request $request)
    {

        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Car::paginate(5);

        if($from != null & $to != null)
        {
        $data = Car::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('car.index',compact('data','from','to'))->with(request()->input('page'));
        // return view('car.index', compact('data'))->with(request()->input('page'));

    }
    public function create(){
        return view('car.create');
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'car_number' => 'required',
            'car_code'=>'required'
        ]);

        if($validator->fails()){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }else{
            $car=Car::create($input);
            Alert::success('success','You have successed');
            return redirect()->route('cars.index');
        }
    }

    public function show( $id)
    {
        $car=Car::find($id);
        if(is_null($car)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
       // $data=$car;
        return view("car.show",compact('car'));

    }
    public function edit(Car $car){
        return view('car.edit',compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            "car_number"=>"required",
            "car_code"=>"required"
        ]);
        if($validator->fails()){
            return Alert::error('Failed', 'Please, check your data again');
        }
        $car->car_number=$input['car_number'];
        $car->car_code=$input['car_code'];
        $car->save();
        Alert::success('success','You have successed');
        return redirect()->route('cars.index');

    }


    // public function destroy($id)
    // {
    //     $car=Car::find($id);
    //     if($car == NULL){
    //         return redirect()->route('cars.index');
    //     }
    //     $car->delete();
    //     Alert::success('success','You delete successfully');
    //     return back();

    // }
    public function archivecar(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Car::paginate(15);

        if($from != null & $to != null)
        {
        $data = Car::whereBetween('created_at', [$from, $to])->paginate(5);
        }

        $data = Car::onlyTrashed()->latest()->paginate(5);
        return view('car.archivecar',compact('data','from','to'));

    }

    public function destroy(Car $car)
    {
        $car -> delete();
        //return redirect()->route('cars.index')->with('success','car deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('cars.index');
    }
    public function softDelete($id)
    {
        $car = Car::find($id)->delete();//علشان يدور ب الid

        // return redirect()->route('cars.index')->with('success','car deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('cars.index');
    }
    public function deleteForEver($id)
    {
        $car = Car::onlyTrashed()->where('id',$id)->forceDelete();

       // return redirect()->route('cars.trash')->with('success','car deleted successfully');
       Alert::success('success','You deleted successfully');
        return redirect()->route('cars.index');
    }
    public function backFromSoftDelete($id)
    {
        $car = Car::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('cars.index')->with('success','car back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('cars.index');

    }
    // public function report(){
    //     $query= DB::table('cars')->select()->get();
    //     // $role= DB::table('users')
    //     //     ->select('users.role_id_user',);
    //     return view('car.index',compact('query'));
    // }
    // public function search(){

    // }

    // public function report(Request $request){
    //     if(Auth::id()== null){
    //         return redirect(route('login'));
    //     }

    //     $from = $request->has('fromDate') ? $request->get('fromDate'):null;
    //     $to = $request->has('toDate') ? $request->get('toDate'):null;

    //     $data = Car::paginate(5);

    //     if($from != null & $to != null)
    //     {
    //     $data = Car::whereBetween('created_at', [$from, $to])->paginate(5);
    //     }

    //     // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


    //     return view('car.report',compact('data','from','to'));
    // }
}
