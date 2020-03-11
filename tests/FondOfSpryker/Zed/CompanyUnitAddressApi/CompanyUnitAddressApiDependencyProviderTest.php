<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider
     */
    protected $companyUnitAddressApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiDependencyProvider = new CompanyUnitAddressApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companyUnitAddressApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companyUnitAddressApiDependencyProvider->providePersistenceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
