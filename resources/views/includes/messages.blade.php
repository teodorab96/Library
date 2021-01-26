@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
        @if (session('returnDate'))
            i mora biti vracena do: {{session('returnDate')}}
        @endif
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
