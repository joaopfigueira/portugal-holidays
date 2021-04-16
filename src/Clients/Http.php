<?php

namespace Holidays\Clients;

use GuzzleHttp\Client as HttpClient;

class Http extends HttpClient implements ClientInterface
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => 'https://services.sapo.pt',
        ]);
    }

    /**
     * Returns holidays of a given year as a string
     *
     * @param  int year
     * @return string
     */
    public function fetch(int $year): string
    {
        $response = $this->request('GET', '/Holiday/GetNationalHolidays?year='.$year);
        $body = $response->getBody();
        return $body->getContents();
    }
}
