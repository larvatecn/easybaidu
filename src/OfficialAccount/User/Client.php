<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\OfficialAccount\User;

use EasyBaidu\OfficialAccount\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取粉丝列表
     * @param int $page_no 查询页码，不传默认为1
     * @param int $page_size 查询条数，不传默认为30，大于30设置为30
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fansListall($page_no = 1, $page_size = 30)
    {
        return $this->httpPostJson('builderinner/open/resource/query/fansListall', compact('page_no', 'page_size'));
    }

    /**
     * 获取用户详情
     * @param string $uk 加密用户标识，从用户列表获取
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fansData($uk)
    {
        return $this->httpPostJson('builderinner/open/resource/query/fansData', compact('uk'));
    }
}