<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }
    public function books(Request $request){
        if($request->get('search')!=NULL){
            $this->validate($request,[
                'search' => 'required|max:255',
                'status' => 'required'
            ]);
            $book= Book::where('naslov', 'like', "%{$request->input('search')}%")->where('status', 'SLOBODNA')->paginate(9);
        }
        else{
            $book = Book::orderBy('status')->paginate(9);
        }
        return view('pages.books')->with('books',$book);
    }
}
