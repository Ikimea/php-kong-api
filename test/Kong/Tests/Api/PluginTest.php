<?php

namespace IKimea\Kong\Tests\Api;

use PHPUnit\Framework\TestCase;
use Ikimea\Kong\Client;
use Ikimea\Kong\Api\Plugin;
use Psr\Http\Message\ResponseInterface;

class PluginTest extends TestCase
{
    public function testHasPlugin()
    {
        $response = $this->prophesize(ResponseInterface::class);
        $response->getHeaderLine("Content-Type")->willReturn('application/json');
        $response->getBody()->willReturn(json_encode([
            'data' => [['name' => 'oAuth2']]
        ]));

        $guzzleClient = $this->prophesize(\GuzzleHttp\Client::class);
        $guzzleClient->get('plugins/', [])->willReturn($response->reveal());

        $client = $this->prophesize(Client::class);
        $client->getHttpClient()->willReturn($guzzleClient->reveal());

        $plugin = new Plugin($client->reveal());
        $this->assertTrue($plugin->has('oAuth2'));
    }

    public function testCreatePlugin()
    {
        $guzzleClient = $this->prophesize(\GuzzleHttp\Client::class);
        $response = $this->prophesize(ResponseInterface::class);
        $guzzleClient->post('plugins/',  ['json' => [
            'name' => 'oAuth2',
            'config.enable_password_grant' => true
        ]], [])->shouldBeCalled()->willReturn($response->reveal());;

        $client = $this->prophesize(Client::class);
        $client->getHttpClient()->willReturn($guzzleClient->reveal());

        $plugin = new Plugin($client->reveal());
        $plugin->create(['name' => 'oAuth2', 'config' => ['enable_password_grant' => true]]);
    }
}
