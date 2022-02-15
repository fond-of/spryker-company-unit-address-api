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
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface
     */
    protected $queryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapperMock;

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
        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryBuilderQueryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapperInterface::class)
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
            $this->apiQueryContainerMock,
            $this->apiQueryBuilderQueryContainerMock,
            $this->queryContainerMock,
            $this->companyUnitAddressFacadeMock,
            $this->transferMapperMock
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($this->idCompanyUnitAddress);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
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
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getMessages')
            ->willReturn($this->responseMessageTransferMocks);

        $this->responseMessageTransferMock->expects(static::atLeastOnce())
            ->method('getText')
            ->willReturn($this->errorText);

        try {
            static::assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->add(
                    $this->apiDataTransferMock
                )
            );
        } catch (EntityNotSavedException $e) {
            static::assertInstanceOf(
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
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
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
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn(null);

        try {
            static::assertInstanceOf(
                ApiItemTransfer::class,
                $this->companyUnitAddressApi->get(
                    $this->idCompanyUnitAddress
                )
            );
        } catch (EntityNotFoundException $e) {
            static::assertInstanceOf(
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
        $idCompanyUnitAddress = 1;
        $data = [];

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyUnitAddressTransferMock, $idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyUnitAddressApi->update($idCompanyUnitAddress, $this->apiDataTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotFoundException(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn(null);

        try {
            $this->companyUnitAddressApi->update(
                $this->idCompanyUnitAddress,
                $this->apiDataTransferMock
            );
            static::fail();
        } catch (EntityNotFoundException $e) {
        }
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotSavedException(): void
    {
        $idCompanyUnitAddress = 1;
        $data = [];

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn($this->address1);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn(null);

        $this->companyUnitAddressResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        try {
            $this->companyUnitAddressApi->update(
                $this->idCompanyUnitAddress,
                $this->apiDataTransferMock
            );
            static::fail();
        } catch (EntityNotSavedException $e) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->companyUnitAddressApi->remove(
                $this->idCompanyUnitAddress
            )
        );
    }
}
