<?php
// app/Services/ApiService.php
namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function callExternalApi($endpoint, $method, $data = [], $headers = [])
    {
        $options = [
            'headers' => $headers,
        ];
         
        if (strtoupper($method) === 'GET') {
            $options['query'] = $data;
        } else {
            $options['json'] = $data;
        }

        $response = $this->client->request($method, $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
