<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\baseController as baseController;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        // dd($request);
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Contact::paginate(15);

        if($from != null & $to != null)
        {
        $data = Contact::whereBetween('created_at', [$from, $to])->paginate(5);
        }
        //  dd([$from,$to]);

        // $data= DB::select("SELECT * FROM cars WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");


        return view('contact.index',compact('data','from','to'))->with(request()->input('page'));
        // $data=Customer::latest()->paginate(5);
        // return view('customer.index', compact('data'))->with(request()->input('page'));

    }
    public function create(){
        return redirect()->next();
    }

    public function show( $id)
    {
        $contact=Contact::find($id);
        if(is_null($contact)){
            Alert::error('Failed', 'Please, check your data again');
            return back();
        }
        return view("contact.show",compact('contact'));

    }

    public function store(Request $request)
    {
        $input=$request->all();

        $validator=Validator::make($input,[
        "email" => 'required|email',
        "subject" => 'required',
        "message" => 'required'
        ]);


        // if($validator->fails()){
        //     session()->flash('Error', "Something went wrong please try again" );
        //        return redirect()->route("index");
        // }
        if($validator->fails()){
            Alert::error('Failed', 'Please, Try again');
            return back();
        }
        else{
            $contact=Contact::create($input);
            Alert::success('Success', 'We will contact you' );

               return redirect()->route("index");
        }

    }


    // public function destroy($id)
    // {
    //     //delete the product
    //     $contact=Contact::find($id);
    //     if($contact==NULL){
    //         return redirect()->route('index');
    //     }
    //     $contact->delete();
    //     //redirect the user
    //     Alert::success('success','You delete successfully');
    //     return back();
    // }
    public function trashcontact(Request $request)
    {
        // dd('arrive to controller');
        $from = $request->has('fromDate') ? $request->get('fromDate'):null;
        $to = $request->has('toDate') ? $request->get('toDate'):null;

        $data = Contact::paginate(5);

        if($from != null & $to != null)
        {
        $data = Contact::whereBetween('created_at', [$from, $to])->paginate(5);
        }

        $data = Contact::onlyTrashed()->latest()->paginate(5);
        return view('contact.trash',compact('data','from','to'));

    }
    public function destroy(Contact $contact)
    {
        $contact -> delete();
        //return redirect()->route('contacts.index')->with('success','contact deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('contacts.index');
    }
    public function softDelete($id)
    {
        $contact = Contact::find($id)->delete();//علشان يدور ب الid

       // return redirect()->route('orders.index')->with('success','driver deleted successfully');
       Alert::success('success','You deleted successfully');
       return redirect()->route('contacts.index');
    }
    public function deleteForEver($id)
    {
        $contact = Contact::onlyTrashed()->where('id',$id)->forceDelete();

        //return redirect()->route('orders.trash')->with('success','order deleted successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('contacts.index');
    }
    public function backFromSoftDelete($id)
    {
        $contact = Contact::onlyTrashed()->where('id',$id)->first()->restore();
        //return redirect()->route('orders.index')->with('success','order back successfully');
        Alert::success('success','You deleted successfully');
        return redirect()->route('contacts.index');

    }
}

