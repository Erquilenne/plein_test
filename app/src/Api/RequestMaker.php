<?php


namespace App\Api;


use GuzzleHttp\Client;
use http\Client\Response;

class RequestMaker
{
    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest(string $method, string $url, array $params): Response
    {
        $client = new Client();

        $response = $client->request($method, $url, $params);

        return $response->getBody();

    }
}