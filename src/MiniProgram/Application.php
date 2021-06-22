<?php

namespace EasyBaidu\MiniProgram;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected array $providers = [

        // Base services
    ];

    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
