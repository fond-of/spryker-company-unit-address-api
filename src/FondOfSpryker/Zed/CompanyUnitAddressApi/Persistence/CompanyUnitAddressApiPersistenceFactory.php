<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence;

use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 */
class CompanyUnitAddressApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }
}
