<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade
     */
    protected $companyUnitAddressApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory
     */
    protected $companyUnitAddressApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface
     */
    protected $companyUnitAddressApiInterfaceMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface
     */
    protected $companyUnitAddressApiValidatorInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock = $this->getMockBuilder(CompanyUnitAddressApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiInterface::class)
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

        $this->companyUnitAddressApiValidatorInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyUnitAddress = 1;

        $this->companyUnitAddressApiFacade = new CompanyUnitAddressApiFacade();
        $this->companyUnitAddressApiFacade->setFactory($this->companyUnitAddressApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompanyUnitAddress(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiInterfaceMock);

        $this->companyUnitAddressApiInterfaceMock->expects($this->atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiFacade->addCompanyUnitAddress(
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddress(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiInterfaceMock);

        $this->companyUnitAddressApiInterfaceMock->expects($this->atLeastOnce())
            ->method('get')
            ->with($this->idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiFacade->getCompanyUnitAddress(
                $this->idCompanyUnitAddress
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddress(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiInterfaceMock);

        $this->companyUnitAddressApiInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiFacade->updateCompanyUnitAddress(
                $this->idCompanyUnitAddress,
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testRemoveCompanyUnitAddress(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiInterfaceMock);

        $this->companyUnitAddressApiInterfaceMock->expects($this->atLeastOnce())
            ->method('remove')
            ->with($this->idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApiFacade->removeCompanyUnitAddress(
                $this->idCompanyUnitAddress
            )
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyUnitAddress(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiInterfaceMock);

        $this->companyUnitAddressApiInterfaceMock->expects($this->atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->companyUnitAddressApiFacade->findCompanyUnitAddresses(
                $this->apiRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUnitAddressApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyUnitAddressApiValidator')
            ->willReturn($this->companyUnitAddressApiValidatorInterfaceMock);

        $this->companyUnitAddressApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray(
            $this->companyUnitAddressApiFacade->validate(
                $this->apiDataTransferMock
            )
        );
    }
}
