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
            @if ($book->users!=null)
                @foreach ($book->users as $reservation)
                    @if ($reservation->pivot->approved==0)
                        <tr>
                            <th scope="row">{{$book->naslov}}</th>
                            <td>{{$book->ime_autora}}</td>
                            <td>{{$book->izdavac}}</td>
                            <td>{{$book->kategorija}}</td>
                            <td>{{$book->stampara}}</td>
                            <td>
                                <a href="/approveRent/{{$book->id}}" class="btn btn-success mt-1">Odobri izdavanje</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <h1 class="mb-5 text-center text-white-50 bg-secondary"><i><b>Nema zahtjeva za iznajmljivanje</b></i></h1>
                    </td>
                </tr>
                @break
            @endif
        @endforeach
    </tbody>
  </table>
@else 
  <div class="mb-5 text-center text-white-50 bg-secondary"><h1><i><b>Nema knjiga</b></i></h1></div>
@endif
@endsection
    