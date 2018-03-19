<?php

namespace Ikimea\Kong\Api;

class Consumer extends AbstractApi
{
    public function has($name)
    {
        $response = $this->get('/consumers/' . $name, ['http_errors' => false]);

        return $this->exist($response);
    }

    public function create($data)
    {
        return $this->post('/consumers/', [
            'json' => $data
        ]);
    }

    /**
     * @param $type
     * @param $data
     * @return array|string
     */
    public function createApplication($type, $data)
    {
        $id = $data['consumer_id'];
        unset($data['id']);

        return $this->post(sprintf('/consumers/%s/%s', $id, $type), [
            'json' => $data
        ]);
    }

    public function hasApplication($id, $type)
    {
        $response = $this->get(sprintf('/consumers/%s/%s', $id, $type));

        return $response['total'] > 0;
    }

    public function showApplication($id, $type)
    {
        return $this->get(sprintf('/consumers/%s/%s', $id, $type));
    }

    public function show($name)
    {
        return $this->get('/consumers/' . $name);
    }
}
