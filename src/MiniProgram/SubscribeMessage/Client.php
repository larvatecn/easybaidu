<?php

namespace EasyBaidu\MiniProgram\SubscribeMessage;

use EasyBaidu\Kernel\BaseClient;
use EasyBaidu\Kernel\Exceptions\InvalidArgumentException;
use ReflectionClass;

/**
 * Class Client.
 *
 * @author hugo <rabbitzhang52@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * {@inheritdoc}.
     */
    protected $message = [
        'template_id' => '',
        'touser_openId' => '',
        'subscribe_id' => '',
        'data' => [],
        'page' => '',
    ];

    /**
     * {@inheritdoc}.
     */
    protected $required = ['template_id', 'touser_openId', 'subscribe_id', 'data'];

    /**
     * Send a template message.
     *
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $data = [])
    {
        $params = $this->formatMessage($data);
        $this->restoreMessage();
        return $this->httpPost('rest/2.0/smartapp/template/message/subscribe/send', $params);
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatMessage(array $data = []): array
    {
        $params = array_merge($this->message, $data);
        foreach ($params as $key => $value) {
            if (in_array($key, $this->required, true) && empty($value) && empty($this->message[$key])) {
                throw new InvalidArgumentException(sprintf('Attribute "%s" can not be empty!', $key));
            }
            $params[$key] = empty($value) ? $this->message[$key] : $value;
        }

        foreach ($params['data'] as $key => $value) {
            if (is_array($value)) {
                if (\array_key_exists('value', $value)) {
                    $params['data'][$key] = ['value' => $value['value']];
                    continue;
                }
                if (count($value) >= 1) {
                    $value = [
                        'value' => $value[0],
                    ];
                }
            } else {
                $value = [
                    'value' => strval($value),
                ];
            }

            $params['data'][$key] = $value;
        }

        return $params;
    }

    /**
     * Restore message.
     */
    protected function restoreMessage()
    {
        $this->message = (new ReflectionClass(static::class))->getDefaultProperties()['message'];
    }
}
