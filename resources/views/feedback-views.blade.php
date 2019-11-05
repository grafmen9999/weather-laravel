@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3">
        <div class="card position-relative">
            <div class="card-header">

                <div class="row">
                    <div class="col"style="font-size: 2.5em;">{{ __("Views feedback") }}</div>
                    @isset($feedback)
                    <ul class="pagination text-center">
                        <li class="page-item"><a href="@if($feedback->id === 1) {{ url('feedback-views/'.$lastIndex) }} @else {{ url('feedback-views/'.($feedback->id-1)) }} @endif" class="page-link">Previous</a></li>

                        @for ($i = -1; $i <= 1; $i++)
                            @if ($feedback->id > 1 && $feedback->id < $lastIndex)
                                <li class="page-item @if ($i === 0) {{__('active')}} @endif"><a href="{{ url('feedback-views/'.($feedback->id + $i)) }}" class="page-link">{{ $feedback->id + $i }}</a></li>
                            @elseif ($feedback->id === 1)
                                <li class="page-item @if ($i === -1) {{__('active')}} @endif"><a href="{{ url('feedback-views/'.($feedback->id + ($i + 1))) }}" class="page-link">{{ $feedback->id + ($i + 1) }}</a></li>
                            @elseif ($feedback->id === $lastIndex)
                                <li class="page-item @if ($i === 1) {{__('active')}} @endif"><a href="{{ url('feedback-views/'.($feedback->id + ($i - 1))) }}" class="page-link">{{ $feedback->id + ($i - 1) }}</a></li>
                            @endif
                        @endfor
                        
                        <li class="page-item"><a href="@if($feedback->id === $lastIndex) {{ url('feedback-views/1') }} @else {{ url('feedback-views/'.($feedback->id + 1)) }} @endif" class="page-link">Next</a></li>
                    </ul>
                    <a href="{{ url('feedback-views') }}" class="btn btn-link">Back to list</a>
                    @endisset
                </div>
            </div>
            <div class="card-body">
                @isset($feedback)
                <div class="row">
                    <div class="col text-center">{{ __('Name') }}</div>
                    <div class="col text-center">{{ __('E-Mail Address') }}</div>
                    <div class="col-5 text-center">{{ __('Message') }}</div>
                </div> <!-- end div.row -->
                <div class="row">
                    <div class="col text-center">{{ $feedback->name }}</div>
                    <div class="col text-center">{{ $feedback->email }}</div>
                    <div class="col-5 text-center"><pre>{{ $feedback->message }}</pre></div>
                </div>
                @else
                <div class="row overflow-auto">
                    @foreach ($feedbacks as $feedback)
                    <div class="col-md-12">
                        <a href="{{ url('feedback-views/'.$feedback->id) }}" class="btn btn-link">{{ $feedback->message }}</a>
                    </div>
                    @endforeach
                </div> <!-- end div.row -->
                @endisset
            </div>
        </div>
        
    </div>
@endsection