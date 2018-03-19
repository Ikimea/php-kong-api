<?php

namespace Ikimea\Kong\Api;

class OAuth2 extends AbstractApi
{
    public function createToken($data)
    {
        return $this->post('/oauth2_tokens/', [
            'json' => $data
        ]);
    }
}
