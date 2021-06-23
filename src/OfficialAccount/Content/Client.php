<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\OfficialAccount\Content;

use EasyBaidu\OfficialAccount\BaseClient;

class Client extends BaseClient
{
    /**
     * 发布文章
     * @param string $title 文章标题，限定8-40个中英文字符以内
     * @param string $content 正文内容，限制20000个中英文字符内，富文本
     * @param string $origin_url 原文地址，相同URL的文章会被认为是同一篇文章，禁止提交
     * @param array $cover_images 文章封面图片地址url, 0-3张封面图，封面图尺寸不小于218*146，可以为空，没有封面图的内容将会进入草稿
     * @param int $is_original 标定是否原创，1 为原创，0 为非原创
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articlePublish($title, $content, $origin_url, $cover_images, $is_original = 1)
    {
        return $this->httpPostJson('builderinner/open/resource/article/publish', compact('title', 'content', 'origin_url', 'cover_images', 'is_original'));
    }

    /**
     * @param string $title 文章标题，限定8-40个中英文字符以内
     * @param string $content 正文内容，限制20000个中英文字符内，富文本
     * @param string $origin_url 原文地址，相同URL的文章会被认为是同一篇文章，禁止提交
     * @param array $cover_images 文章封面图片地址url, 0-3张封面图，封面图尺寸不小于218*146，可以为空，没有封面图的内容将会进入草稿
     * @param string $article_id 需要修改的文章ID
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleRepublish($title, $content, $origin_url, $cover_images, $article_id)
    {
        return $this->httpPostJson('builderinner/open/resource/article/republish', compact('title', 'content', 'origin_url', 'cover_images', 'article_id'));
    }

    /**
     * 发布图集
     * @param string $title 文章标题，限定8-40个中英文字符以内
     * @param array $photograph 至少4张图片，desc描述为0-200个汉字；不支持GIF格式；封面图尺寸不小于400*224
     * @param string $origin_url 图集资源原地址url，相同URL的文章会被认为是同一篇文章，禁止提交
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleGallery($title, $photograph, $origin_url)
    {
        return $this->httpPostJson('builderinner/open/resource/article/gallery', compact('title', 'photograph', 'origin_url'));
    }

    /**
     * 发布视频
     * @param string $title 视频标题，限定 8-40 个中英文字符以内
     * @param string $video_url 视频原地址，目前支持 mp4 等，不支持 m3u8
     * @param string $cover_images 视频封面图片地址 url, 目前只支持 1 张图片作为封面，封面图尺寸不小于660*370
     * @param int $use_auto_cover 是否使用自动封面，1为使用自动封面，其余为不使用自动封面
     * @param int $is_original 标定是否原创，1 为原创，0 为非原创
     * @param string $tag 视频tag，tag之间以半角英文逗号分割，每个tag长度不超过10个字符，最多支持10个tag
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function videoPublish($title, $video_url, $cover_images, $use_auto_cover, $is_original, $tag)
    {
        return $this->httpPostJson('builderinner/open/resource/video/publish', compact('title', 'video_url', 'cover_images', 'use_auto_cover', 'is_original', 'tag'));
    }

    /**
     * 图片搜索批量传图服务
     * @param array $image_list 批量上传的图片信息对应的 数组
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function imagePush($image_list)
    {
        return $this->httpPostJson('builderinner/open/resource/image/pushPic', compact('image_list'));
    }

    /**
     * 文章撤回
     * @param string $article_id 需要撤回的文章ID
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleWithdraw($article_id)
    {
        return $this->httpPostJson('builderinner/open/resource/article/withdraw', compact('article_id'));
    }

    /**
     * 获取文章列表
     * @param string $start_time 支持按照年月日格式（2019-06-01）进行查询，仅支持查询到日维度的数据
     * @param string $end_time 支持按照年月日格式（2019-07-01）进行查询，仅支持查询到日维度的数据
     * @param int $page_no 查询页码，不传默认为1
     * @param int $page_size 查询条数，不能超过20，不传默认为20
     * @param string $article_type 文章类型，news-图文、gallery-图集、video-视频，不传默认查询所有支持的文章类型
     * @param string $collection 文章状态集，不传默认查询所有支持的文章状态集 draft-草稿、publish-已发布、pre_publish-待发布、withdraw-已撤回、rejected-未通过
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleListAll($start_time, $end_time, $page_no = 1, $page_size = 20, $article_type = null, $collection = null)
    {
        $data = [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'page_no' => $page_no,
            'page_size' => $page_size
        ];
        if ($article_type) {
            $data['article_type'] = $article_type;
        }
        if ($collection) {
            $data['collection'] = $collection;
        }
        return $this->httpPostJson('builderinner/open/resource/query/articleListall', $data);
    }

    /**
     * 查询文章状态
     * @param string $article_id
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status($article_id)
    {
        return $this->httpPostJson('builderinner/open/resource/query/status', compact('article_id'));
    }

    /**
     * 获取文章实时数据
     * @param string $article_id
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleStatistics($article_id)
    {
        return $this->httpPostJson('builderinner/open/resource/query/articleStatistics', compact('article_id'));
    }
}