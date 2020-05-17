<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ResponseMessageTransfer;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyUnitAddressApiTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi
     */
    protected $companyUnitAddressApi;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected $companyUnitAddressApiToApiQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    protected $companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface
     */
    protected $companyUnitAddressApiQueryContainerInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var int
     */
    protected $idCompanyUnitAddress;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ResponseMessageTransfer
     */
    protected $responseMessageTransferMock;

    /**
     * @var array
     */
    protected $responseMessageTransferMocks;

    /**
     * @var string
     */
    protected $errorText;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiQueryContainerInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperInterfaceMock = $this->getMockBuilder(TransferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMessageTransferMock = $this->getMockBuilder(ResponseMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMessageTransferMocks = [
            $this->responseMessageTransferMock,
        ];

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [];

        $this->idCompanyUnitAddress = 1;

        $this->errorText = 'error-text';

        $this->address1 = 'address-1';

        $this->companyUnitAddressApi = new CompanyUnitAddressApi(
            $this->companyUnitAddressApiToApiQueryContainerInterfaceMock,
            $this->companyUnitAddressApiToApiQueryBuilderQueryContainerInterfaceMock,
            $this->companyUnitAddressApiQueryContainerInterfaceMock,
            $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock,
            $this->transferMapperInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($this->idCompanyUnitAddress);

        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApi->add(
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddEntityNotSavedException(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getMessages')
            ->willReturn($this->responseMessageTransferMocks);

        $this->responseMessageTransferMock->expects($this->atLeastOnce())
            ->method('getText')
            ->willReturn($this->errorText);

        try {
            $this->assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->add(
                    $this->apiDataTransferMock
                )
            );
        } catch (EntityNotSavedException $e) {
            $this->assertInstanceOf(
                EntityNotSavedException::class,
                $e
            );
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApi->get(
                $this->idCompanyUnitAddress
            )
        );
    }

    /**
     * @return void
     */
    public function testGetEntityNotFoundException(): void
    {
        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn(null);

        try {
            $this->assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->get(
                    $this->idCompanyUnitAddress
                )
            );
        } catch (EntityNotFoundException $e) {
            $this->assertInstanceOf(
                EntityNotFoundException::class,
                $e
            );
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($this->idCompanyUnitAddress);

        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApi->update(
                $this->idCompanyUnitAddress,
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotFoundException(): void
    {
        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn(null);

        try {
            $this->assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->update(
                    $this->idCompanyUnitAddress,
                    $this->apiDataTransferMock
                )
            );
        } catch (EntityNotFoundException $e) {
            $this->assertInstanceOf(
                EntityNotFoundException::class,
                $e
            );
        }
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotSavedException(): void
    {
        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressApiToCompanyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('update')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyUnitAddressResponseTransferMock->expects($this->atLeastOnce())
            ->method('getMessages')
            ->willReturn($this->responseMessageTransferMocks);

        $this->responseMessageTransferMock->expects($this->atLeastOnce())
            ->method('getText')
            ->willReturn($this->errorText);

        try {
            $this->assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->update(
                    $this->idCompanyUnitAddress,
                    $this->apiDataTransferMock
                )
            );
        } catch (EntityNotSavedException $e) {
            $this->assertInstanceOf(
                EntityNotSavedException::class,
                $e
            );
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {

        $this->companyUnitAddressApiToApiQueryContainerInterfaceMock->expects($this->atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        $this->assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApi->remove(
                $this->idCompanyUnitAddress
            )
        );
    }
}
