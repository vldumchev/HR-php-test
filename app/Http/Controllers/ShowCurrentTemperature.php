<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DarkSkyApi;

class ShowCurrentTemperature extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(Request $request)
    {
        $country = $request->query('country');
        $city    = $request->query('city');

        $location = $this->getLocation($country, $city);

        $options = [];

        if (isset($location)) {
            $temperature = $this->getCurrentTemperature($location['lat'], $location['lon']);

            $options['country']     = $country;
            $options['city']        = $city;
            $options['temperature'] = $temperature;
        } else {
            $options['error']       = 'Город не найден';
        }

        return view('current-temperature', $options);
    }

    private function getLocation($country, $city)
    {
        if (empty($country) || empty($city)) {
            return null;
        }

        $geocoder_response = $this->client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'country' => $country,
                'city'    => $city,
                'limit'   => '1',
                'format'  => 'json',
            ],
        ]);

        $geocoder_body = json_decode($geocoder_response->getBody()->getContents(), true);

        return !empty($geocoder_body) ? $geocoder_body[0] : null;
    }

    private function getCurrentTemperature($latitude, $longitude)
    {
        $forecast = DarkSkyApi::location($latitude, $longitude)
            ->units('si')
            ->language('ru')
            ->forecast('currently');

        return $forecast->currently()->temperature();
    }
}
