@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __("Send feedback") }}</div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('feedback-send') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"> {{ __('Name') }}</label>
                                <div class="col-md-6">
                                    @guest
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="text" name="name" id="name" class="form-control" readonly value="{{ Auth::user()->name.' '.Auth::user()->surname }}">
                                    @endguest
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"> {{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    @guest
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="email" name="email" id="email" class="form-control" readonly value="{{ Auth::user()->email }}">
                                    @endguest
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                <div class="col-md-6">
                                    <textarea name="message" id="message" class="form-control" style="resize: none;" rows="10"></textarea>
                                    @error('message')
                                        <div class="alert alert-danger" role="alert"><strong>{{ $message }}</strong></div>
                                    @enderror
                                    
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-25">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection