@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
        @if (session('returnDate'))
            <small>Knjiga mora biti vracena do: {{session('returnDate')}}</small>
        @endif
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
