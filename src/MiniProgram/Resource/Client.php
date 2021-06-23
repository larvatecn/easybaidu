<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\MiniProgram\Resource;

use EasyBaidu\Kernel\BaseClient;

class Client extends BaseClient
{

    /**
     * 提交资源
     * @param array $params
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(array $optional = [])
    {
        $params = array_merge([
            'app_id' => $this->app['config']['app_id']
        ], $optional);
        $this->httpPost('rest/2.0/smartapp/access/submitresource', $params);
    }


    /**
     * 删除资源
     * @param string $path
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $path)
    {
        $params = [
            'path' => $path,
            'app_id' => $this->app['config']['app_id'],
        ];
        $this->httpPost('rest/2.0/smartapp/access/deleteresource', $params);
    }
}