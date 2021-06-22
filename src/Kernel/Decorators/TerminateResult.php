<?php

namespace EasyBaidu\Kernel\Decorators;

/**
 * Class TerminateResult.
 *
 * @author overtrue <i@overtrue.me>
 */
class TerminateResult
{
    /**
     * @var mixed
     */
    public $content;

    /**
     * FinallyResult constructor.
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }
}
