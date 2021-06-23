<?php

namespace EasyBaidu\MiniProgram\Base;

use EasyBaidu\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get unionid.
     *
     * @param string $openid
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUnionid($openid, array $options = [])
    {
        return $this->httpPost('/rest/2.0/smartapp/getunionid', compact('openid') + $options);
    }
}
