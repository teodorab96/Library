<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        session()->put('user_type', $usertype);
        if($usertype=='user' && $userApproved!=NULL){
            return view('pages.index');
        }
        else if($usertype=='user' && $userApproved==NULL){
            session()->flush();
            return view('waitingForAppr');
        }
        else{
            return view('pages.index');
        }
    }
}
