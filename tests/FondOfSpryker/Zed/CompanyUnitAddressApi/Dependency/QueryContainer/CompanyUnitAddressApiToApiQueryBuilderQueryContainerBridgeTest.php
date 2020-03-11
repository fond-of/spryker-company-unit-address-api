<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class CompanyUnitAddressApiToApiQueryBuilderQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerBridge
     */
    protected $companyUnitAddressApiToApiQueryBuilderQueryContainerBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected $apiQueryBuilderQueryTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PropelQueryBuilderCriteriaTransfer
     */
    protected $propelQueryBuilderCriteriaTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected $modelCriteriaMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock = $this->getMockBuilder(ApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryTransferMock = $this->getMockBuilder(ApiQueryBuilderQueryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->propelQueryBuilderCriteriaTransferMock = $this->getMockBuilder(PropelQueryBuilderCriteriaTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToApiQueryBuilderQueryContainerBridge = new CompanyUnitAddressApiToApiQueryBuilderQueryContainerBridge(
            $this->apiQueryBuilderQueryContainerInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testToPropelQueryBuilderCriteria(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('toPropelQueryBuilderCriteria')
            ->with($this->apiQueryBuilderQueryTransferMock)
            ->willReturn($this->propelQueryBuilderCriteriaTransferMock);

        $this->assertInstanceOf(
            PropelQueryBuilderCriteriaTransfer::class,
            $this->companyUnitAddressApiToApiQueryBuilderQueryContainerBridge->toPropelQueryBuilderCriteria(
                $this->apiQueryBuilderQueryTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testBuilderQueryFromRequest(): void
    {
        $this->apiQueryBuilderQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('buildQueryFromRequest')
            ->with(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock
            )->willReturn($this->modelCriteriaMock);

        $this->assertInstanceOf(
            ModelCriteria::class,
            $this->companyUnitAddressApiToApiQueryBuilderQueryContainerBridge->buildQueryFromRequest(
                $this->modelCriteriaMock,
                $this->apiQueryBuilderQueryTransferMock
            )
        );
    }
}
