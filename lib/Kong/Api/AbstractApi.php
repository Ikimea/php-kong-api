<?php

namespace Ikimea\Kong\Api;

use Ikimea\Kong\Client;
use Ikimea\Kong\Message\ResponseMediator;

abstract class AbstractApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $path
     * @param array $requestHeaders
     * @return array|string
     */
    public function get($path, array $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->get(
            $path,
            $requestHeaders
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * @param $path
     * @param $body
     * @param array $requestHeaders
     * @return array|string
     */
    public function post($path, $body, array $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $body,
            $requestHeaders
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * @param $response
     * @return bool
     */
    public function exist($response): bool
    {
        if (isset($response['message']) && 'Not found' == $response['message']) {
            return false;
        }

        return true;
    }
}
