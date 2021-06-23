<?php

namespace EasyBaidu\MiniProgram\AppCode;

use EasyBaidu\Kernel\BaseClient;
use EasyBaidu\Kernel\Http\StreamResponse;

/**
 * 小程序二维码
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * 获取短链
     *
     * @param string $path
     * @param array $optional
     *
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function get(string $path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        return $this->getStream('rest/2.0/smartapp/qrcode/get', $params);
    }

    /**
     * 获取长链
     *
     * @param string $path
     * @param array $optional
     *
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function getUnlimit(string $path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        return $this->getStream('rest/2.0/smartapp/qrcode/getunlimited', $params);
    }

    /**
     * Get stream.
     *
     * @param string $endpoint
     * @param array $params
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getStream(string $endpoint, array $params)
    {
        $response = $this->requestRaw($endpoint, 'POST', ['form_params' => $params]);
        if (false !== stripos($response->getHeaderLine('Content-Type'), 'image/png')) {
            return StreamResponse::buildFromPsrResponse($response);
        }
        return $this->castResponseToType($response, $this->app['config']->get('response_type'));
    }
}
