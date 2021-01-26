<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

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
            $booksReserv = User::find(auth()->user()->id)->booksReservation()->get();
            return view('librarian.allBooks')->with('books',$books)->with('reservation',$booksReserv);

    }
    /**Funkcija za prikaz rezervacije knjige  */
    public function reserveBook($id){
        $users = User::all()->where('type','user');
        $book = Book::find($id);
        return view('librarian.reserveBook')->with('book',$book)->with('users',$users);
    }
    /**
     * Reseracija knjige od strane bibliotekara za odabranog korisnika*/
    public function reserve(Request $request)
    {
        if($request->method()=="POST"){
            $this->validate($request,[
                'user' => 'required',
            ]);
            DB::table('reservations')->insert([
                'user_id' => $request->input('user'),
                'book_id'=> $request->input('book'),
                'created_at' => now(),
            ]);
            return redirect('/allBooks')->with('success','Knjiga rezervisana');
            }
            else{
                return redirect('/allBooks')->with('error','Greška prilikom rezervacije knjige');
            }
        /** 
        * 
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