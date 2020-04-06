<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressApiTransfer;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapper
     */
    protected $transferMapper;

    /**
     * @var array
     */
    protected $transferData;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->transferData = [
            [],
        ];

        $this->transferMapper = new TransferMapper();
    }

    /**
     * @return void
     */
    public function testToTransfer(): void
    {
        $this->assertInstanceOf(
            CompanyUnitAddressApiTransfer::class,
            $this->transferMapper->toTransfer(
                $this->transferData
            )
        );
    }

    /**
     * @return void
     */
    public function testToTransferCollection(): void
    {
        $this->assertIsArray(
            $this->transferMapper->toTransferCollection(
                $this->transferData
            )
        );
    }
}
