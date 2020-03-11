<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainer;
use Spryker\Zed\Kernel\Container;

class CompanyUnitAddressApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory
     */
    protected $companyUnitAddressApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected $companyUnitAddressApiToApiQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    protected $companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainer
     */
    protected $companyUnitAddressApiQueryContainerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiQueryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiBusinessFactory = new CompanyUnitAddressApiBusinessFactory();
        $this->companyUnitAddressApiBusinessFactory->setContainer($this->containerMock);
        $this->companyUnitAddressApiBusinessFactory->setQueryContainer($this->companyUnitAddressApiQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApi(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API],
                [CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER],
                [CompanyUnitAddressApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS]
            )->willReturnOnConsecutiveCalls(
                $this->companyUnitAddressApiToApiQueryContainerInterfaceMock,
                $this->companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock,
                $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock
            );

        $this->assertInstanceOf(
            CompanyUnitAddressApiInterface::class,
            $this->companyUnitAddressApiBusinessFactory->createCompanyUnitAddressApi()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressApiValidator(): void
    {
        $this->assertInstanceOf(
            CompanyUnitAddressApiValidatorInterface::class,
            $this->companyUnitAddressApiBusinessFactory->createCompanyUnitAddressApiValidator()
        );
    }
}
