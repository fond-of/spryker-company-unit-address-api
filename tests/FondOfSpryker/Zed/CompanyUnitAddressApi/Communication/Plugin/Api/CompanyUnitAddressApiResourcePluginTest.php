<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade;
use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api\CompanyUnitAddressApiResourcePlugin
     */
    protected $companyUnitAddressApiResourcePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade
     */
    protected $companyUnitAddressApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var int
     */
    protected $idCompanyUnitAddress;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyUnitAddress = 1;

        $this->companyUnitAddressApiResourcePlugin = new CompanyUnitAddressApiResourcePlugin();
        $this->companyUnitAddressApiResourcePlugin->setFacade($this->companyUnitAddressApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(
            CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES,
            $this->companyUnitAddressApiResourcePlugin->getResourceName()
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('addCompanyUnitAddress')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiResourcePlugin->add(
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->with($this->idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiResourcePlugin->get(
                $this->idCompanyUnitAddress
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('updateCompanyUnitAddress')
            ->with($this->idCompanyUnitAddress, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiResourcePlugin->update(
                $this->idCompanyUnitAddress,
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('removeCompanyUnitAddress')
            ->with($this->idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiResourcePlugin->remove(
                $this->idCompanyUnitAddress
            )
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyUnitAddresses')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->companyUnitAddressApiResourcePlugin->find(
                $this->apiRequestTransferMock
            )
        );
    }
}
