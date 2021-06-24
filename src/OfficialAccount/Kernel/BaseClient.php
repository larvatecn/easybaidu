<?php

namespace EasyBaidu\OfficialAccount\Kernel;

use EasyBaidu\Kernel\Support;
use EasyBaidu\Kernel\Traits\HasHttpRequests;
use EasyBaidu\OfficialAccount\Application;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    use HasHttpRequests {
        request as performRequest;
    }

    /**
     * @var \EasyBaidu\OfficialAccount\Application
     */
    protected $app;

    /**
     * Constructor.
     *
     * @param \EasyBaidu\OfficialAccount\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->setHttpClient($this->app['http_client']);
    }

    /**
     * Extra request params.
     *
     * @return array
     */
    protected function prepends()
    {
        return [];
    }

    /**
     * Make a API request.
     *
     * @param string $endpoint
     * @param array $params
     * @param string $method
     * @param array $options
     * @param bool $returnResponse
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $endpoint, array $params = [], $method = 'post', array $options = [], $returnResponse = false)
    {
        $base = [
            'app_id' => $this->app['config']['app_id'],
            'app_token' => $this->app['config']['app_token'],
        ];

        $params = array_filter(array_merge($base, $this->prepends(), $params), 'strlen');

        $options = array_merge([
            'json' => $params,
        ], $options);

        $this->pushMiddleware($this->logMiddleware(), 'log');
        $response = $this->performRequest($endpoint, $method, $options);
        return $returnResponse ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    /**
     * Log the request.
     *
     * @return \Closure
     */
    protected function logMiddleware()
    {
        $formatter = new MessageFormatter($this->app['config']['http.log_template'] ?? MessageFormatter::DEBUG);

        return Middleware::log($this->app['logger'], $formatter);
    }

    /**
     * Make a request and return raw response.
     *
     * @param string $endpoint
     * @param array $params
     * @param string $method
     * @param array $options
     * @return ResponseInterface
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function requestRaw(string $endpoint, array $params = [], $method = 'post', array $options = [])
    {
        /** @var ResponseInterface $response */
        $response = $this->request($endpoint, $params, $method, $options, true);
        return $response;
    }

    /**
     * Make a request and return an array.
     *
     * @param string $endpoint
     * @param array $params
     * @param string $method
     * @param array $options
     * @return array
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function requestArray(string $endpoint, array $params = [], $method = 'post', array $options = []): array
    {
        $response = $this->requestRaw($endpoint, $params, $method, $options);
        return $this->castResponseToType($response, 'array');
    }


}