<?php
namespace EasyBaidu\Tests;

use EasyBaidu\Factory;

class FactoryTest extends TestCase
{
    public function testStaticCall()
    {
        $this->assertInstanceOf(
            \EasyBaidu\MiniProgram\Application::class,
            Factory::miniProgram(['appid' => 'appid@789'])
        );
    }
}