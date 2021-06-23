<?php

namespace EasyBaidu\MiniProgram\Auth;

use EasyBaidu\Kernel\BaseClient;

/**
 * Class Auth.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * @var string
     */
    protected $baseUri = 'https://spapi.baidu.com/';

    /**
     * Get session info by code.
     *
     * @param string $code
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     */
    public function session(string $code)
    {
        $params = [
            'client_id' => $this->app['config']['app_id'],
            'sk' => $this->app['config']['secret'],
            'code' => $code,
        ];
        return $this->httpGet('oauth/jscode2sessionkey', $params);
    }
}
