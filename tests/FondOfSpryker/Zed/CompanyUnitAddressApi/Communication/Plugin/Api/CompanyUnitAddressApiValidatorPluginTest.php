<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade;
use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUnitAddressApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api\CompanyUnitAddressApiValidatorPlugin
     */
    protected $companyUnitAddressApiValidatorPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade
     */
    protected $companyUnitAddressApiFacadeMock;

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

        $this->companyUnitAddressApiValidatorPlugin = new CompanyUnitAddressApiValidatorPlugin();
        $this->companyUnitAddressApiValidatorPlugin->setFacade($this->companyUnitAddressApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertSame(
            CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES,
            $this->companyUnitAddressApiValidatorPlugin->getResourceName()
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray(
            $this->companyUnitAddressApiValidatorPlugin->validate(
                $this->apiDataTransferMock
            )
        );
    }
}
