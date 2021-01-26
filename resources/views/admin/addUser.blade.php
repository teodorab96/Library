@extends('layouts.app')

@section('content')
<div class="container w-50 text-center">
    <form method='post' action="/addUser">
        @csrf
        <div class="form-group"> 
            <label for="name">Ime</label>
            <input id="name" type="text" class="form-control text-center @error('name') is-invalid @enderror"  name="name">
          </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input id="email" type="text" class="form-control text-center @error('email') is-invalid @enderror"  name="email">
        </div>
        <div class="form-group">
            <label for="password">Lozinka:</label>
            <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror"  name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Potvrdi lozinku:</label>
            <input id="password_confirmation" type="password" class="form-control text-center @error('password_confirmation') is-invalid @enderror"  name="password_confirmation">
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="user" value="user" checked>
            <label class="form-check-label" for="user">Korisnik</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="librarian" value="librar">
            <label class="form-check-label" for="librarian">Bibliotekar</label>
          </div>
        <button type="submit" class="btn btn-warning" name="submit">Dodaj korisnika</button>
      </form>
</div>

@endsection