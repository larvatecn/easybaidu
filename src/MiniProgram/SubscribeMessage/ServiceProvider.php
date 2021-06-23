<?php

namespace EasyBaidu\MiniProgram\SubscribeMessage;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['subscribe_message'] = function ($app) {
            return new Client($app);
        };
    }
}
