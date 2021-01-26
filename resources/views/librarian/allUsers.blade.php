@extends('layouts.app')

@section('content')

@if(count($users)>0)
<table class="table text-center">
    <thead class="thead-dark text-left">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ime</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>@if($user->approved_at!=NULL)
                 <h4 class="border border-success text-success">Verifikovan</h4>
                @else 
                 <a href="/allUsers/{{$user->id}}" class="btn btn-danger">Verifikuj</a>
                @endif
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
@else 
  <div class="mb-5 text-center text-white-50 bg-secondary"><h1><i><b>Nema korisnika</b></i></h1></div>
@endif
@endsection