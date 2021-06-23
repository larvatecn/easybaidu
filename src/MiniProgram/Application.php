<?php

namespace EasyBaidu\MiniProgram;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * 小程序应用入口
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        Base\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        Sitemap\ServiceProvider::class,
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
     * @param array $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
