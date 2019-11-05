@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row text-info ml-0">
                        @guest
                            Info for Guest
                        @else
                            Info for user {{ Auth::user()->name.' '.Auth::user()->surname }}
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
