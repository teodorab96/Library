<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Reservation;

class PagesController extends Controller
{
    /**Vraća početnu stranu */
    public function index(){
        return view('pages.index');
    }

    /**Prikaz sviih knjiga na strani knjige */
    public function books(Request $request){
        if($request->method()=="POST"){
            $this->validate($request,[
                'search' => 'required|max:255',
                'status' => 'required'
            ]);
            $book= Book::where('naslov', 'like', "%{$request->input('search')}%")->where('status','=',$request->input('status') )->orderBy('status')->paginate(9);
        }
        else{
            $book = Book::orderBy('status')->paginate(9);
        } 
        return view('pages.books')->with('books',$book);
    }

        /** Prikazivanje greške ako se pokušava iznajmljivanje guest-a */
        public function loginNeeded($id){
            return redirect('books')->with('error','Morate biti ulogovani');
        }
}
