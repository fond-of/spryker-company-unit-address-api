<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacadeInterface getFacade()
 */
class CompanyUnitAddressApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer[]
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}
