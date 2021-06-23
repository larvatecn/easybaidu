<?php

namespace EasyBaidu\MiniProgram\TemplateMessage;

use EasyBaidu\Kernel\BaseClient;
use EasyBaidu\Kernel\Exceptions\InvalidArgumentException;
use ReflectionClass;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    public const API_SEND = 'rest/2.0/smartapp/template/send';

    /**
     * {@inheritdoc}.
     */
    protected $message = [
        'template_id' => '',
        'touser_openId' => '',
        'data' => [],
        'page' => '',
        'form_id' => '',
        'scene_id' => '',
        'scene_type' => '',
    ];

    /**
     * {@inheritdoc}.
     */
    protected $required = ['touser_openId', 'template_id', 'data', 'scene_id', 'scene_type'];

    /**
     * @param array $data
     * @return array
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
        $params['data'] = $this->formatData($params['data'] ?? []);
        return $params;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function formatData(array $data): array
    {
        $formatted = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (\array_key_exists('value', $value)) {
                    $formatted[$key] = $value;
                    continue;
                }
                if (count($value) >= 2) {
                    $value = [
                        'value' => $value[0],
                        'color' => $value[1],
                    ];
                }
            } else {
                $value = [
                    'value' => strval($value),
                ];
            }

            $formatted[$key] = $value;
        }
        return $formatted;
    }

    /**
     * Restore message.
     */
    protected function restoreMessage()
    {
        $this->message = (new ReflectionClass(static::class))->getDefaultProperties()['message'];
    }

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
        return $this->httpPost(static::API_SEND, $params);
    }

    /**
     * 添加模板
     * @param string $id
     * @param array $keyword
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(string $id, array $keyword)
    {
        return $this->httpPost('rest/2.0/smartapp/template/templateadd', [
            'id' => $id,
            'keyword_id_list' => $keyword,
        ]);
    }

    /**
     * 删除模板
     * @param string $templateId
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $templateId)
    {
        return $this->httpPost('rest/2.0/smartapp/template/templatedel', [
            'template_id' => $templateId,
        ]);
    }

    /**
     * 获取模板列表
     * @param int $offset
     * @param int $count
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTemplates(int $offset, int $count)
    {
        return $this->httpGet('rest/2.0/smartapp/template/templatelist', compact('offset', 'count'));
    }

    /**
     * @param string $id
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id)
    {
        return $this->httpGet('rest/2.0/smartapp/template/libraryget', compact('id'));
    }

    /**
     * 获取模板库模板
     * @param int $offset
     * @param int $count
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyBaidu\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(int $offset, int $count)
    {
        return $this->httpGet('rest/2.0/smartapp/template/librarylist', compact('offset', 'count'));
    }
}