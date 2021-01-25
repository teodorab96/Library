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
    /**Rezervacija knjige
     * 
     * 
     */
    public function rent($id){
        $book = Book::find($id);
        if($book->status =='SLOBODNA'){
            $dateNow = Carbon::today();
            $rentDate = $dateNow->addDays(30);
            DB::table('rent_books')->insert([
                'user_id' => auth()->user()->id,
                'book_id'=> $id,
                'rent_date' => $dateNow,
                'return_book' => $rentDate
            ]);
            DB::table('books')->where('id', $id)->update(['status' => 'IZDATA']);
        /**
         * $rent = new RentBook;
         * $rent->user_id = auth()->user()->id;
         * $rent->book_id = auth()->user()->id;
         * $rent->rent_date = $dateNow;
         * $rent->return_book = $rentDate;
         * $rent->save();
         *  */  
        $displayRentDate =Carbon::createFromFormat('Y-m-d H:i:s', $rentDate)->format('d-m-Y');
        return redirect('/books')->with('success','Knjiga je iznajmljena')->with('returnDate',$displayRentDate);  
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
