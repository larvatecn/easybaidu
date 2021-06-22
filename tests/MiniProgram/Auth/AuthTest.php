<?php

namespace EasyBaidu\Tests\MiniProgram\Auth;

use EasyBaidu\Kernel\ServiceContainer;
use EasyBaidu\MiniProgram\Auth\Client;
use EasyBaidu\Tests\TestCase;

class AuthTest extends TestCase
{
    public function testGetSessionKey()
    {
        $client = $this->mockApiClient(Client::class, [], new ServiceContainer(['app_id' => 'app-id', 'secret' => 'mock-secret']));

        $client->expects()->httpGet('sns/jscode2session', [
            'client_id' => 'app-id',
            'sk' => 'mock-secret',
            'code' => 'js-code',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->session('js-code'));
    }
}