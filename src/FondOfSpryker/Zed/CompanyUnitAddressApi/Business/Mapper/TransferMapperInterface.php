<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressApiTransfer;

interface TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressApiTransfer
     */
    public function toTransfer(array $data): CompanyUnitAddressApiTransfer;

    /**
     * @param array $data
     *
     * @return array<\Generated\Shared\Transfer\CompanyUnitAddressApiTransfer>
     */
    public function toTransferCollection(array $data): array;
}
