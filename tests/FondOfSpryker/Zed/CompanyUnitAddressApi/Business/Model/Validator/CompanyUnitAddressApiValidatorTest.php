<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUnitAddressApiValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator
     */
    protected $companyUnitAddressApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferData = [
            'address1' => 'address1',
            'zip_code' => 'zip_code',
            'fk_country' => 'fk_country',
            'iso2_code' => 'iso2_code',
        ];

        $this->companyUnitAddressApiValidator = new CompanyUnitAddressApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->assertIsArray(
            $this->companyUnitAddressApiValidator->validate(
                $this->apiDataTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testValidateError(): void
    {
        $this->apiDataTransferMock->expects($this->atLeastOnce())
            ->method('getData')
            ->willReturn($this->transferData);

        $this->assertIsArray(
            $this->companyUnitAddressApiValidator->validate(
                $this->apiDataTransferMock
            )
        );
    }
}
