<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Pocetna strana nakon login-a
     */
    public function index()
    {
        $userInfo = User::firstWhere('id', auth()->user()->id);
        $usertype =$userInfo->type;
        $userApproved = $userInfo->approved_at;
        if($usertype=='user' && $userApproved!=NULL){
            return view('pages.index');

        }
        else if($usertype=='user' && $userApproved==NULL){
            Auth::logout();
            Session::invalidate();    
            Session::regenerateToken();

        //Slanje notifikacije
            $allWorkers=User::where('type','librar') ->orWhere('type', 'admin');
            foreach($allWorkers as $worker){
                $worker->notify(new NewUser(auth()->user()));
            }

            return view('waitingForAppr');
        }
        else{
            return view('pages.index');
        }
    }
    /**Prikaz stane za kreiranje korisnika  */
    public function addUser(){
        return view('admin.addUser');
    }
    /**Dodavanje korisnika u bazu */
    public function storeUser(Request $request)
    {
        if($request->method()=="POST"){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'type' => 'required',
        ]);
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = $request->input('type');
        $user->approved_at = Carbon::now();
        $user->save();
        return redirect('/addUser')->with('success','Korisnik uspješno dodat');
        }
        else{
            return redirect('/addUser')->with('error','Greška prilikom dodavanja korisnika u bazu');
        }
    }
}
