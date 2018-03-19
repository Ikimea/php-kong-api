<?php

namespace Ikimea\Kong\Api;

class Plugin extends AbstractApi
{
    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        $content = $this->get('plugins/');
        if (isset($content['data'])) {
            foreach ($content['data'] as $data) {
                if ($data['name'] == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param array $data
     *
     * @return array|string
     */
    public function create(array $data)
    {
        $parameters = ['name' => $data['name']];

        foreach ($data['config'] as $key => $value) {
            $parameters["config.$key"] = $value;
        }

        return $this->post('plugins/', [
            'json' => $parameters
        ]);
    }
}
