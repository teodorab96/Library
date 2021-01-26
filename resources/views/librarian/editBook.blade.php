@extends('layouts.app')

@section('content')
<div class="container w-50 text-center">
    <form method='post' action="/editBook/{{$book->id}}">
        @csrf
        <div class="form-group"> 
            <label for="naziv">Naziv knjige:</label>
            <input id="naziv" type="text" class="form-control text-center @error('naslov') is-invalid @enderror"  name="naslov" value="{{$book->naslov}}" readonly>
          </div>
        <div class="form-group">
          <label for="autor">Ime Autora:</label>
          <input id="autor" type="text" class="form-control text-center @error('autor') is-invalid @enderror"  name="autor" value="{{$book->ime_autora}}" readonly>
        </div>
        <div class="form-group">
            <label for="izdavac">Izdavač:</label>
            <input id="izdavac" type="text" class="form-control text-center @error('izdavac') is-invalid @enderror"  name="izdavac" value="{{$book->izdavac}}" readonly>
        </div>
        <div class="form-group">
            <label for="kategorija">Kategorija:</label>
            <input id="kategorija" type="text" class="form-control text-center @error('kategorija') is-invalid @enderror"  name="kategorija" value="{{$book->kategorija}}" readonly>
        </div>
        <div class="form-group">
            <label for="stampara">Štampara:</label>
            <input id="stampara" type="text" class="form-control text-center @error('stampara') is-invalid @enderror"  name="stampara" value="{{$book->stampara}}" readonly>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="user" value="SLOBODNA" @if($book->status=='SLOBODNA')checked @endif>
            <label class="form-check-label" for="user">Slobodna</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="izdata" value="IZDATA" @if($book->status=='IZDATA')checked @endif>
            <label class="form-check-label" for="izdata">Izdata</label>
        </div>
        <button type="submit" class="btn btn-warning" name="submit">Ažuriraj knjigu</button>
      </form>
</div>

@endsection