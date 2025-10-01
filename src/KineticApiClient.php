<?php

namespace Riclep\KineticApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Riclep\KineticApi\Exceptions\KineticApiException;

class KineticApiClient
{
    protected string $baseUrl;
    protected string $apiSecret;

    public function __construct()
    {
        $this->baseUrl = config('kinetic.base_url');
        $this->apiSecret = config('kinetic.api_secret');
    }

    /**
     * @throws KineticApiException
     */
    public function get(string $endpoint, array $params = []): mixed
    {
        return $this->request('GET', $endpoint, $params);
    }

    /**
     * @throws KineticApiException
     */
    public function post(string $endpoint, array $data = []): mixed
    {
        return $this->request('POST', $endpoint, [], $data);
    }

    /**
     * @throws KineticApiException
     */
    protected function request(string $method, string $endpoint, array $queryParams = [], array $data = []): mixed
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

        try {
            $response = Http::timeout(config('kinetic.timeout'))
                ->withHeaders([
                    'key' => $this->apiSecret,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->withQueryParameters($queryParams);

            $response = $method === 'POST' ? $response->post($url, $data) : $response->get($url);

            $this->handleErrors($response);

            return $this->handleResponse($response);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            throw new Exceptions\KineticApiException(
                "Connection error: {$e->getMessage()}. URL: {$url}",
                $e->getCode() ?: 408 // Use 408 Request Timeout as default code
            );
        }
    }

    /**
     * @throws KineticApiException
     */
    protected function handleErrors(Response $response): void
    {
        if ($response->failed()) {
            throw new Exceptions\KineticApiException(
                $response->json('message', 'Unknown error'),
                $response->status()
            );
        }
    }

    protected function handleResponse(Response $response): mixed
    {
        return $response->json();
    }
}
