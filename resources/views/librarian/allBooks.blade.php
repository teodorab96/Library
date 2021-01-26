@extends('layouts.app')

@section('content')
@if(count($books)>0)
<table class="table text-center">
    <thead class="thead-dark text-left">
      <tr>
        <th scope="col">Naslov</th>
        <th scope="col">Autor</th>
        <th scope="col">Izdavac</th>
        <th scope="col">Kategorija</th>
        <th scope="col">Stampara</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <th scope="row">{{$book->naslov}}</th>
            <td>{{$book->ime_autora}}</td>
            <td>{{$book->izdavac}}</td>
            <td>{{$book->kategorija}}</td>
            <td>{{$book->stampara}}</td>
            <td>@if($book->status=='SLOBODNA')
                 <h6 class="border border-success text-success w-50 m-auto">Slobodna</h6>
                 @if (count($book->usersReservation)>0)
                    <p class="border bg-dark border-warning text-warning w-75 mt-1 m-auto">Knjiga je rezervisana</p>
                 @else
                    <a href="/reserveBook/{{$book->id}}" class="btn btn-success mt-1">Rezerviši</a>
                 @endif
                @else 
                 <h6 class="border border-danger text-danger">Izdata</h6>
                @endif
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
  <div class="container mt-3">
    <div class="row">
        <div class="col-5"></div>
        <div class="col-4">
            {{$books->links()}}
        </div>
        <div class="col"></div>
    </div>
</div>
@else 
  <div class="mb-5 text-center text-white-50 bg-secondary"><h1><i><b>Nema knjiga</b></i></h1></div>
@endif
@endsection