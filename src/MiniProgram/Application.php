<?php

namespace EasyBaidu\MiniProgram;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,

        Base\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        // Base services
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'base_uri' => 'https://openapi.baidu.com/',
        ],
    ];


    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
