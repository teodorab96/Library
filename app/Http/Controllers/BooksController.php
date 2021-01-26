<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**Izdavanje knjige*/
    public function rent($id){
        $book = Book::find($id);
        if($book->status =='SLOBODNA'){
            $dateNow = Carbon::now();
            $rentDate = $dateNow->addDays(30);
            DB::table('rent_books')->insert([
                'user_id' => auth()->user()->id,
                'book_id'=> $id,
                'rent_date' => $dateNow,
                'return_book' => $rentDate,
            ]);
            $displayRentDate =Carbon::createFromFormat('Y-m-d H:i:s', $rentDate)->format('d-m-Y');
            return redirect('/books')->with('success','Zahtjev za iznajmljivanje poslat bibliotekaru')->with('returnDate',$displayRentDate);  
        }
        else{
            return redirect('/books')->with('error','Knjiga nije dostupna');
        }

    }
    /**
     * Istorija svih knjiga jednog korisnika
     */
    public function history(){
        $books = User::find(auth()->user()->id)->books()->get();
        return view('pages.history')->with('books',$books);
    }
    /* Unošenje knjige u bazu prikaz view-a.*/
    public function create()
    {
        return view('librarian.addBook');
    }

    /**
     *Smještanje knjige u bazu
     */
    public function store(Request $request)
    {
        if($request->method()=="POST"){
        $this->validate($request,[
            'naslov' => 'required',
            'autor' => 'required',
            'izdavac' => 'required',
            'kategorija' => 'required',
            'stampara' => 'required'
        ]);
        $book = new Book;
        $book->naslov = $request->input('naslov');
        $book->ime_autora = $request->input('autor');
        $book->izdavac = $request->input('izdavac');
        $book->kategorija = $request->input('kategorija');
        $book->stampara = $request->input('stampara');
        $book->status = "SLOBODNA";
        $book->save();
        return redirect('/addBook')->with('success','Knjiga uspješno dodata');
        }
        else{
            return redirect('/addBook')->with('error','Nije post metod');
        }
    }
    /** Rezervacija knjige */
    public function reserve($id){
        DB::table('reservations')->insert([
            'user_id' => auth()->user()->id,
            'book_id'=> $id,
            'created_at' => now(),
        ]);
        return redirect('/books')->with('success','Knjiga rezervisana');
    }

}
