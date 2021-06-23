<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\MiniProgram\RiskControl;

use EasyBaidu\Kernel\BaseClient;

/**
 * 风控
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * 检测用户是否是作弊用户
     * @param string $xtoken 小程序通过swan-getSystemRiskInfo获取的内容,格式：{"key":"xxxx","value":"xxxx"}
     * @param string $type
     * @param string $clientip
     * @param string $ev
     * @param string $useragent
     * @param string $phone
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detectrisk($xtoken, $type, $clientip, $ev = '', $useragent = '', $phone = '')
    {
        $params = [
            'app_key' => $this->app['config']['app_key'],
            'xtoken' => $xtoken,
            'type' => $type,
            'clientip' => $clientip,
            'ts' => time(),
            'ev' => $ev,
            'useragent' => $useragent,
            'phone' => sha1($phone)
        ];
        return $this->httpPost('rest/2.0/smartapp/access/submitsitemap/api', $params);
    }
}