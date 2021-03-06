<?php

namespace EasyBaidu;

/**
 * Class Factory.
 *
 * @method static \EasyBaidu\OfficialAccount\Application        officialAccount(array $config)
 * @method static \EasyBaidu\MiniProgram\Application        miniProgram(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array $config
     *
     * @return \EasyBaidu\Kernel\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\EasyBaidu\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}