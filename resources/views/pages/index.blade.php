@extends('layouts.app')

@section('content')
    <div class="card mt-5">
    <div class="card-body text-center text-primary">
      @auth
        <h1 class="text-success">Uspjesno ste prijavljeni</h1>
      @endauth
      @guest
        <h1 class="text-primary">DOBRODOSLU U ONLINE KNJIZARU</h1>
      @endguest
    </div>
  </div>
@endsection