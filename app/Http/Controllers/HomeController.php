<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SimpleHtmlDom\simple_html_dom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function weather()
    {
        $url = "https://www.gismeteo.ua/weather-zaporizhia-5093/";
        // $url = "https://www.gismeteo.ua/weather-odessa-4982/";

        $ch = curl_init();

        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        curl_setopt_array($ch, $options);

        $r = curl_exec($ch);
        // curl_close($ch);

        if ($r == false) {
            return curl_error($ch);
        }

        $html = new simple_html_dom($r);

        $data = array();

        $data['current-time'] = trim($html->find('time', 0)->plaintext); // Current time from server
        $data['current-temperature-1'] = trim($html->find('.tab-content .temperature.tab-weather__value .unit.unit_temperature_c', 0)->plaintext);
        $data['current-temperature-2'] = trim($html->find('.tab-content .temperature.tab-weather__feel .unit.unit_temperature_c', 0)->plaintext);
        $data['current-about-weather'] = trim($html->find('.tabs a', 0)->{'data-text'});
        $data['current-about-weather-img'] = $html->find('.tabs .tab_wrap .tab-icon .img', 0);

        $data['country'] = trim($html->find('ul.breadcrumbs__list li a span', 0)->plaintext);
        $data['region'] = trim($html->find('ul.breadcrumbs__list li a span', 1)->plaintext);
        $data['city'] = trim($html->find('ul.breadcrumbs__list li a span', 2)->plaintext);

        for ($i = 0; $i < 8; $i++) {
            $data['widget-time'][] = trim($html->find('.widget__container .widget__item .w_time', $i)->plaintext);
            $data['widget-about-weather'][] = trim($html->find('.widget__container .widget__item span.tooltip', $i)->{'data-text'});
            $data['widget-temperature'][] = trim($html->find('.widget__container .w_temperature .value .unit_temperature_c', $i)->plaintext);
            $data['widget-speed-wind'][] = trim($html->find('.widget__container .w_wind .unit_wind_m_s', $i)->plaintext);
            $data['widget-wind-direction'][] = trim($html->find('.widget__container .w_wind__direction', $i)->plaintext);
            $data['widget-wind-direction-arrow'][] = $html->find('.widget__container .w_wind .w_wind__icon.wind_arrow', $i);
        }

        $data['widget-precipitanion-without'] = trim($html->find('.widget__container .widget__row_precipitation .w_prec__without', 0));

        if (empty($data['widget-precipitanion-without'])) {
            for ($i = 0; $i < 8; $i++) {
                $data['widget-precipitation'][] = trim($html->find('.widget__container .widget__row_precipitation .w_prec .w_prec__value', $i)->plaintext);
            }
        } else {
            $data['widget-precipitanion-without'] = trim($html->find('.widget__container .widget__row_precipitation .w_prec__without', 0)->plaintext);
        }


        return view("weather", ['data' => $data]);
    }

}
