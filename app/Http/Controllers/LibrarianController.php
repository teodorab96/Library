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
            return view('librarian.allBooks')->with('books',$books);

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
    }
    /**Prikaz svih knjiga za iznajmljivanje */
    public function requestBook(){
        $books = Book::orderBy('status')->paginate(10);
        return view('librarian.requestedBook')->with('books',$books);
    } 
    /*Odobravanje zahtjeva za izdavanje knjige */
    public function approveRentBook($id){
        DB::table('books')->where('id', $id)->update(['status' => 'IZDATA']); 
        DB::table('rent_books')->where('book_id',$id)->update(['approved' => 1]);
        return redirect('/requestBook')->with('success','Odobreno je izdavanje knjige');
    }
    /*Brisanje knjige */
    public function deleteBook($id){
        DB::table('rent_books')->where('book_id', '=', $id)->delete();
        DB::table('reservations')->where('book_id', '=', $id)->delete();
        $book = Book::find($id);
        $book->delete();
        return redirect('/allBooks')->with('success','Knjiga je uklonjena');
    }

    /*Mijenjanje knjige*/
    public function editBook($id){
        $book = Book::find($id);
        return view('librarian.editBook')->with('book',$book);
    }
    public function changeBook(Request $request,$id){
        DB::table('books')->where('id', $id)->update(['status' => $request->input('status')]);
        return redirect('librarian.editBook')->with('success','Uspješno ažuriran status knjige');
    }
}
