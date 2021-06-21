<?php

namespace EasyBaidu\Kernel\Events;

use EasyBaidu\Kernel\ServiceContainer;

/**
 * Class ApplicationInitialized.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ApplicationInitialized
{
    /**
     * @var \EasyBaidu\Kernel\ServiceContainer
     */
    public $app;

    /**
     * @param \EasyBaidu\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }
}
