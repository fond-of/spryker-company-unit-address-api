<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacadeInterface getFacade()
 */
class CompanyUnitAddressApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES;
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->addCompanyUnitAddress($apiDataTransfer);
    }

    /**
     * @api
     *
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get($id): ApiItemTransfer
    {
        return $this->getFacade()->getCompanyUnitAddress($id);
    }

    /**
     * @api
     *
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFacade()->updateCompanyUnitAddress($id, $apiDataTransfer);
    }

    /**
     * @api
     *
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove($id): ApiItemTransfer
    {
        return $this->getFacade()->removeCompanyUnitAddress($id);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFacade()->findCompanyUnitAddresses($apiRequestTransfer);
    }
}
