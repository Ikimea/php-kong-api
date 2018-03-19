<?php

namespace Ikimea\Kong\Api;

class Api extends AbstractApi
{
    public function has($name)
    {
        $response = $this->get('/apis/' . $name, ['http_errors' => false]);

        return $this->exist($response);
    }

    public function list()
    {
        return $this->get('apis/');
    }

    public function create($data)
    {
        return $this->post('apis/', [
            'json' => $data
        ]);
    }
}
