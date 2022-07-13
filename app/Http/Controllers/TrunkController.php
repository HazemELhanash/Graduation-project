<?php

namespace App\Http\Controllers;

use App\Models\Trunk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\trunkResource as trunkResource;
use App\Http\Controllers\baseController as baseController;
use RealRashid\SweetAlert\Facades\Alert;

class TrunkController extends baseController
{

    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Trunk::paginate(15);

        if($from != null & $to != null)
        {
        $data = Trunk::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('trunk.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Trunk::latest()->paginate(5);
        // return view("trunk.index", compact('data'))->with(request()->input('page'));
    }
    public function create()
    {
        return view('trunk.create');
    }

    public function store(Request $request)
    {
        $input=$request->only('trunk_code');
        $validator=Validator::make($input,[
            'trunk_code' => 'required'
        ]);

        if($validator->fails()){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        else{
            $trunk=Trunk::create($input);
            Alert::success('success','You have successed');
            return redirect()->route('trunks.index');
        }
    }
    public function show( $id)
    {
        $trunk=Trunk::find($id);
        if(is_null($trunk)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        return view('trunk.show',compact('trunk'));
    }
    public function edit(Trunk $trunk){
        return view('trunk.edit',compact('trunk'));
    }


    public function update(Request $request, Trunk $trunk)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            "trunk_code"=>"required"
        ]);
        if($validator->fails()){
            return Alert::error('Failed', 'Please, check your data again');
        }
        $trunk->trunk_code=$input['trunk_code'];
        $trunk->save();
        Alert::success('success','You have successed');
        return redirect()->route('trunks.index');
    }
    // public function destroy( $id)
    // {
    //     $trunk=Trunk::find($id);
    //     if($trunk==NULL){
    //         return redirect()->route('trunks.index');
    //     }
    //     $trunk->delete();
    //     Alert::success('success','You delete successfully');
    //     return back();
    // }
    public function trashtrunk(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Trunk::paginate(5);

        if($from != null & $to != null)
        {
        $data = Trunk::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        $data = Trunk::onlyTrashed()->latest()->paginate(5);
        return view('trunk.trash',compact('data','from','to'));

    }
    public function destroy(Trunk $trunk)
    {
        $trunk -> delete();
        //return redirect()->route('trunks.index')->with('success','trunk deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('trunks.index');
    }
    public function softDelete($id)
    {
        $trunk = Trunk::find($id)->delete();//علشان يدور ب الid

        //return redirect()->route('trunks.index')->with('success','trunk deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('trunks.index');
    }
    public function deleteForEver($id)
    {
        $trunk = Trunk::onlyTrashed()->where('id',$id)->forceDelete();

       // return redirect()->route('trunks.trash')->with('success','trunk deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('trunks.index');
    }
    public function backFromSoftDelete($id)
    {
        $trunk = Trunk::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('trunks.index')->with('success','trunk back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('trunks.index');
    }
}
