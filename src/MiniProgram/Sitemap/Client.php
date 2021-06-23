<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\MiniProgram\Sitemap;

use EasyBaidu\Kernel\BaseClient;

/**
 * Class Client
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * 提交单条Url
     * @param string $type
     * @param string|array $url_list
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function api($type, $url_list)
    {
        if (is_array($url_list)) {
            $url_list = implode(',', $url_list);
        }
        return $this->httpPost('rest/2.0/smartapp/access/submitsitemap/api', compact('type', 'url_list'));
    }

    /**
     * 提交站点地图
     * @param string $url sitemap 链接
     * @param string $type 类型 1-增量/更新； 0-下线/删除
     * @param string $frequency 更新频率 3-每天 4-每周
     * @param string $desc 描述信息
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit($url, $type, $frequency, $desc)
    {
        $params = [
            'url' => $url,
            'type' => $type,
            'frequency' => $frequency,
            'desc' => $desc,
            'app_id' => $this->app['config']['app_id'],
        ];
        return $this->httpPost('rest/2.0/smartapp/access/submitsitemap', $params);
    }

    /**
     * 删除 sitemap
     * @param string $url
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($url)
    {
        $params = [
            'url' => $url,
            'app_id' => $this->app['config']['app_id'],
        ];
        return $this->httpPost('rest/2.0/smartapp/access/deletesitemap', $params);
    }
}