<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\MiniProgram\Sitemap;

use EasyBaidu\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 提交站点地图
     * @param string $url
     * @param string $type
     * @param string $frequency
     * @param string $desc
     * @param int $app_id
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit($url, $type, $frequency, $desc, $app_id)
    {
        $this->httpPostJson('rest/2.0/smartapp/access/submitsitemap', compact('url', 'type', 'frequency', 'desc', 'app_id'));
    }

    /**
     * 删除 sitemap
     * @param string $url
     * @param string $app_id
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($url, $app_id = '')
    {
        $this->httpPostJson('rest/2.0/smartapp/access/deletesitemap', compact('url', 'app_id'));
    }
}