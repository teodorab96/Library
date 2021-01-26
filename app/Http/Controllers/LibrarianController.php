<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class LibrarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = User::all()->where('type','user');
            return view('librarian.allUsers')->with('users',$users);

    }
    public function approveUser($id){
        $today= Carbon::now()->toDateTimeString();
        if($id){
            $user = User::find($id); 
            $user->approved_at = $today;
            $user->save();
            
        }
            $users = User::all()->where('type','user');
            return view('librarian.allUsers')->with('users',$users);
    }
    /**Prikazivanje svih knjiga */
    public function showBooks()
    {
            $books = Book::orderBy('status')->paginate(10);
            return view('librarian.allBooks')->with('books',$books);

    }
    /**Funkcija za prikaz rezervacije knjige  */
    public function reserveBook($id){
        $users = User::all()->where('type','user');
        $book = Book::find($id);
        return view('librarian.reserveBook')->with('book',$book)->with('users',$users);
    }
    /**
     * Reseracija knjige
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reserve(Request $request)
    {
        $this->validate($request,[
            'user' => 'required',
        ]);
        /** 
        * $rezervacija = new Reservation;
        * $rezervacija->user_id = $request->input('user');
        * $rezervacija->book_id = $request->input('book');
        * $rezervacij->save();
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
