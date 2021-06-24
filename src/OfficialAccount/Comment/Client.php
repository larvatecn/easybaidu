<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace EasyBaidu\OfficialAccount\Comment;

use EasyBaidu\OfficialAccount\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 获取作者评论列表
     * @param string|int $offset 不传默认从第一条开始取，分页查询时请传入上一次查询返回的offset+1
     * @param string|int $limit 查询条数，不传默认为20，不能超过20
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authorListall($offset = 1, $limit = 20)
    {
        return $this->httpPostJson('builderinner/open/resource/query/commentAuthorListall', compact('offset', 'limit'));
    }

    /**
     * 获取文章评论统计
     * @param string|int $page_no 查询页码，不传默认为1
     * @param string|int $page_size 查询条数，不能超过30，不传默认为30
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleListAll($page_no = 1, $page_size = 30)
    {
        return $this->httpPostJson('builderinner/open/resource/query/commentArticleListall', compact('page_no', 'page_size'));
    }

    /**
     * 获取单篇文章评论
     * @param string $article_id 文章id，可以从文章列表或评论其他接口获取
     * @param string|int $page_no 查询页码，不传默认为1
     * @param string|int $page_size 查询条数，不能超过20，不传默认为20
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleCommentList($article_id, $page_no = 1, $page_size = 20)
    {
        return $this->httpPostJson('builderinner/open/resource/query/articleCommentList', compact('article_id', 'page_no', 'page_size'));
    }

    /**
     * 获取文章评论回复
     * @param string $article_id 文章id，可以从文章列表或评论其他接口获取
     * @param string $reply_id 被回复的评论的id，可以从文章列表或者评论其他接口获取
     * @param string|int $page_no 查询页码，不传默认为1
     * @param string|int $page_size 查询条数，不能超过20，不传默认为20
     * @return array|\EasyBaidu\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyBaidu\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function articleCommentReplyList($article_id, $reply_id, $page_no = 1, $page_size = 20)
    {
        return $this->httpPostJson('builderinner/open/resource/query/articleCommentReplyList', compact('article_id', 'reply_id', 'page_no', 'page_size'));
    }
}