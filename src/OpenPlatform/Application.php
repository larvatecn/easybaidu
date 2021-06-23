<?php

namespace EasyBaidu\OpenPlatform;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \EasyBaidu\OpenPlatform\Comment\Client $comment
 * @property \EasyBaidu\OpenPlatform\Content\Client $content
 * @property \EasyBaidu\OpenPlatform\User\Client $user
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Comment\ServiceProvider::class,
        Content\ServiceProvider::class,
        User\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'base_uri' => 'https://baijiahao.baidu.com/',
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