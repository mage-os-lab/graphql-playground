<?php

declare(strict_types=1);

namespace MageOS\GraphQlPlayground\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;
use MageOS\GraphQlPlayground\Model\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var State |\PHPUnit\Framework\MockObject\MockObject
     */
    private State $stateMock;

    /**
     * @var ScopeConfigInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $scopeConfigMock;

    /**
     * @var Config
     */
    private $sut;

    protected function setUp(): void
    {
        $this->stateMock = $this->createMock(State::class);
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        $this->sut = new Config(
            $this->stateMock,
            $this->scopeConfigMock,
        );
    }

    public function testIsEnabledInDeveloperMode(): void
    {
        $this->stateMock->expects($this->once())
            ->method('getMode')
            ->willReturn(State::MODE_DEVELOPER);

        $this->scopeConfigMock->expects($this->never())->method('isSetFlag');

        $this->assertTrue(
            $this->sut->isEnabled(
                $this->createMock(StoreInterface::class)
            )
        );
    }

    public function testIfIsEnabledBySettingTheRightConfig()
    {
        $this->stateMock->expects($this->once())
            ->method('getMode')
            ->willReturn(State::MODE_PRODUCTION);

        $this->scopeConfigMock->expects($this->once())->method('isSetFlag')->with(
            'dev/graphiql/enabled_in_production',
            ScopeInterface::SCOPE_STORE,
            $this->createMock(StoreInterface::class)
        )->willReturn(true);

        $this->assertTrue(
            $this->sut->isEnabled(
                $this->createMock(StoreInterface::class)
            )
        );
    }

    public function testIfIsDisabledBySettingTheRightConfig()
    {
        $this->stateMock->expects($this->once())
            ->method('getMode')
            ->willReturn(State::MODE_PRODUCTION);

        $this->scopeConfigMock->expects($this->once())->method('isSetFlag')->with(
            'dev/graphiql/enabled_in_production',
            ScopeInterface::SCOPE_STORE,
            $this->createMock(StoreInterface::class)
        )->willReturn(false);

        $this->assertFalse(
            $this->sut->isEnabled(
                $this->createMock(StoreInterface::class)
            )
        );
    }
}
