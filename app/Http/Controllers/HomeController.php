<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
            return view('waitingForAppr');
        }
        else{
            return view('pages.index');
        }
    }
}
