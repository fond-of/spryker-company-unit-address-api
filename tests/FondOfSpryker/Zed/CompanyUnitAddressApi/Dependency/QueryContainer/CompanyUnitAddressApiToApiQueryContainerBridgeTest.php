<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class CompanyUnitAddressApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerBridge
     */
    protected $companyUnitAddressApiToApiQueryContainerBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
     */
    protected $apiQueryContainerInterfaceMock;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryContainerInterfaceMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [];

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToApiQueryContainerBridge = new CompanyUnitAddressApiToApiQueryContainerBridge(
            $this->apiQueryContainerInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiCollection')
            ->with($this->transferData)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->companyUnitAddressApiToApiQueryContainerBridge->createApiCollection(
                $this->transferData
            )
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->apiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->with($this->transferData)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiToApiQueryContainerBridge->createApiItem(
                $this->transferData
            )
        );
    }
}
