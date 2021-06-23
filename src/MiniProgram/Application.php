<?php

namespace EasyBaidu\MiniProgram;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * 小程序应用入口
 * @property \EasyBaidu\MiniProgram\Auth\AccessToken $access_token
 * @property \EasyBaidu\MiniProgram\AppCode\Client $app_code
 * @property \EasyBaidu\MiniProgram\Auth\Client $auth
 * @property \EasyBaidu\MiniProgram\Encryptor $encryptor
 * @property \EasyBaidu\MiniProgram\TemplateMessage\Client $template_message
 * @property \EasyBaidu\MiniProgram\Resource\Client $resource
 * @property \EasyBaidu\MiniProgram\Sitemap\Client $sitemap
 * @property \EasyBaidu\MiniProgram\SubscribeMessage\Client $subscribe_message
 *
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
        Resource\ServiceProvider::class,
        RiskControl\ServiceProvider::class,
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
