<?php

namespace EasyBaidu\Kernel\Events;

use EasyBaidu\Kernel\AccessToken;

/**
 * Class AccessTokenRefreshed.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class AccessTokenRefreshed
{
    /**
     * @var \EasyBaidu\Kernel\AccessToken
     */
    public $accessToken;

    /**
     * @param \EasyBaidu\Kernel\AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
