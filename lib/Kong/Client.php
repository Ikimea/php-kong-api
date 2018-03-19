<?php

namespace Ikimea\Kong;

use Ikimea\Kong\Api\Api;
use Ikimea\Kong\Api\Consumer;
use Ikimea\Kong\Api\Plugin;
use Ikimea\Kong\Api\OAuth2;
use GuzzleHttp\ClientInterface;

class Client
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function api($name)
    {
        switch ($name) {
            case 'api':
                return new Api($this);
                break;
            case 'consumer':
                return new Consumer($this);
                break;
            case 'plugin':
                return new Plugin($this);
                break;
            case 'oauth2':
                return new OAuth2($this);
                break;
        }
    }

    /**
     * @return ClientInterface;
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }
}