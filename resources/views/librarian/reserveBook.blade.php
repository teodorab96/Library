@extends('layouts.app')

@section('content')
    <div class="container w-25 mt-5 mb-5 text-center">
        <div class="row">
            <div class="col">
                <form method="POST" action="/reserveBook/{{$book->id}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <input class="form-control text-center" type="text" value="{{$book->id}}" name="book" readonly>
                      <label>Knjiga: <h4 class="text-dangre">{{$book->naslov}}</h4></label>
                    </div>
                    <div class="form-group">
                      <label for="korisnik">Korisnik:</label>
                      <select class="form-control" id=korisnik" name="user">
                        @if(count($users)>0)
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @else 
                            <option value="NULL">Nema korisnika</option>
                        @endif
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection