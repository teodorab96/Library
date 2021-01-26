@extends('layouts.app')

@section('content')
<div class="container w-50 text-center">
    <form method='post' action="/addBook">
        @csrf
        <div class="form-group"> 
            <label for="naziv">Naziv knjige:</label>
            <input id="naziv" type="text" class="form-control text-center @error('naslov') is-invalid @enderror"  name="naslov">
          </div>
        <div class="form-group">
          <label for="autor">Ime Autora:</label>
          <input id="autor" type="text" class="form-control text-center @error('autor') is-invalid @enderror"  name="autor">
        </div>
        <div class="form-group">
            <label for="izdavac">Izdavač:</label>
            <input id="izdavac" type="text" class="form-control text-center @error('izdavac') is-invalid @enderror"  name="izdavac">
        </div>
        <div class="form-group">
            <label for="kategorija">Kategorija:</label>
            <input id="kategorija" type="text" class="form-control text-center @error('kategorija') is-invalid @enderror"  name="kategorija">
        </div>
        <div class="form-group">
            <label for="stampara">Štampara:</label>
            <input id="stampara" type="text" class="form-control text-center @error('stampara') is-invalid @enderror"  name="stampara">
          </div>
        <button type="submit" class="btn btn-warning" name="submit">Dodaj knjigu</button>
      </form>
</div>

@endsection