@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center text-white-50 bg-secondary mb-5 mt-3">Istorija svih knjiga</h1>
    @if(count($books)>0)
    <div class="row">
        @foreach ($books as $book)
            <div class="col-4 mb-3">
                <div class="card text-center container">
                    <div class="card-header">
                        Autor: {{$book->ime_autora}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$book->naslov}}</h5>
                        <p class="card-text"><b>Izdavač: </b> {{$book->izdavac}}</p>
                        <p class="card-text"><b>Kategorija: </b>{{$book->kategorija}}</p>
                        <p class="card-text"><b>Štampara: </b> {{$book->stampara}}</p>
                    </div>
                    <div class="card-footer text-muted row">
                        <p class="card-text"><b>Status: </b>
                            @if($book->status =='SLOBODNA')
                                Vraćena
                            @else 
                                Vratiti do: {{$book->pivot->return_book}}
                            @endif
                        </p>
                    </div>
              </div>
            </div>
        @endforeach
        </div>
    </div>
    @else

    @endif
@endsection