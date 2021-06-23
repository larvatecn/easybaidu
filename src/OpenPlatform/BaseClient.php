<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\OpenPlatform;

use EasyBaidu\Kernel\ServiceContainer;

abstract class BaseClient extends \EasyBaidu\Kernel\BaseClient
{
    /**
     * @var string
     */
    protected $baseUri = 'https://baijiahao.baidu.com/';

    /**
     * BaseClient constructor.
     *
     * @param \EasyBaidu\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * JSON request.
     *
     * @param string $url
     * @param array $data
     * @param array $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        $data = array_merge($this->getCredentials(), $data);
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');

        // log
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'app_id' => $this->app['config']['app_id'],
            'app_token' => $this->app['config']['app_token'],
        ];
    }
}