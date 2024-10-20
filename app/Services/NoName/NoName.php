<?php

namespace App\Services\NoName;

use GuzzleHttp\Client;

/**
 * This is a boilerplate for the provider api class. Should be updated when api documentation has been provided
 */
class NoName {

    protected Client $client;

    protected $response;

    protected string $apiKey;

    protected string $baseUrl;

    public function __construct() {
        $this->apiKey = '99dls93-299dj-9242'; //env('NONAME_API_KEY');
        $this->baseUrl = '28399-duuwx-92332'; //env('NONAME_BASE_URL');

        /*Should be uncommented when implementing in full
        $this->setRequestOptions();*/

    }

    private function setRequestOptions() : void {

        //this can be changed based on the structure required by the api.
        $authBearer = 'Bearer ' . $this->apiKey;

        $this->client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'headers' => [
                    'Authorization' => $authBearer,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]
        );
    }


    private function setHttpResponse($relativeUrl, $method, $body = []) : NoName {
        $this->response = $this->client->{strtolower($method)}(
            $this->baseUrl . $relativeUrl,
            ["body" => json_encode($body)]
        );

        return $this;
    }


    private function getResponse() {
        return json_decode((string)$this->response->getBody());
    }

    private function getStatusCode() : int {
        return $this->response->getStatusCode();
    }

    /**
     * should be updated based on documentation
     *
     *
     */
    public function updateUserBatch(array $data) {
        $this->setHttpResponse("", 'POST', $data);
        if ($this->getStatusCode() == 200) {
            // carry out necessary actions when request succeed
        }

        //put a proper response when request fails

    }
}
