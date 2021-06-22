<?php

namespace EasyBaidu\Tests\MiniProgram\Auth;

use EasyBaidu\Kernel\ServiceContainer;
use EasyBaidu\MiniProgram\Auth\AccessToken;
use EasyBaidu\Tests\TestCase;

class AccessTokenTest extends TestCase
{
    public function testGetCredentials()
    {
        $app = new ServiceContainer([
            'app_id' => 'mock-app-id',
            'secret' => 'mock-secret',
        ]);
        $token = \Mockery::mock(AccessToken::class, [$app])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame([
            'grant_type' => 'client_credential',
            'client_id' => 'mock-app-id',
            'client_secret' => 'mock-secret',
            'scope' => 'smartapp_snsapi_base'
        ], $token->getCredentials());
    }
}