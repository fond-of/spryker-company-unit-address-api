<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressApiTransfer;

class TransferMapper implements TransferMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressApiTransfer
     */
    public function toTransfer(array $data): CompanyUnitAddressApiTransfer
    {
        return (new CompanyUnitAddressApiTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return array<\Generated\Shared\Transfer\CompanyUnitAddressApiTransfer>
     */
    public function toTransferCollection(array $data): array
    {
        $transferCollection = [];

        foreach ($data as $itemData) {
            $transferCollection[] = $this->toTransfer($itemData);
        }

        return $transferCollection;
    }
}
