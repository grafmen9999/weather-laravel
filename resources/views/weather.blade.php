@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Weather for today') }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span id="region">В {{ $data['country'].' / '.$data['region'].' / '.$data['city'] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>Текущее время: </span><time>{{ trim($data['current-time'], '&nbsp;') }}</time>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <span>Текущая температура: {{ str_replace('&minus;', '-', $data['current-temperature-1']) }}</span>
                    </div>
                    <div class="col-2">
                        <span>По ощущению: {{ str_replace('&minus;', '-', $data['current-temperature-2']) }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 align-self-center text-center">
                        <span>{{ $data['current-about-weather'] }}</span>
                    </div>
                    {{ str_replace('1', '', str_replace('div class="img"', 'div class="img col-3"', print($data['current-about-weather-img']))) }}
                </div>
                <!-- TABLE REGION -->
                <table class="table-dark w-100 text-center">
                    <thead>
                        <tr>
                            <td>{{ __('Время') }}</td>
                            <td>{{ __('Состояние') }}</td>
                            <td>{{ __('Температура') }}</td>
                            <td>{{ __('Скорость ветра') }}</td>
                            <td>{{ __('Направление ветра') }}</td>
                            <td>{{ __('Осадки') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 8; $i++)
                            <tr>
                                <td>{{ str_replace(' ', ':', $data['widget-time'][$i]) }}</td>
                                <td>{{ $data['widget-about-weather'][$i] }}</td>
                                <td>{{ str_replace('&minus;', '-', $data['widget-temperature'][$i]) }}</td>
                                <td>{{ $data['widget-speed-wind'][$i] }}</td>
                                <td>
                                    <div class="row d-flex justify-content-center">
                                        <span>{{ str_replace('1', '', print($data['widget-wind-direction-arrow'][$i]))}}</span>
                                        <span>{{ $data['widget-wind-direction'][$i] }}</span>
                                    </div>
                                </td>
                                @if(empty($data['widget-precipitanion-without']))
                                <td>
                                    {{ $data['widget-precipitation'][$i] }}
                                </td>
                                @else
                                <td>
                                    {{ $data['widget-precipitanion-without'] }}
                                </td>
                                @endif
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection