<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence;

use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiPersistenceFactory getFactory()
 */
class CompanyUnitAddressApiQueryContainer extends AbstractQueryContainer implements CompanyUnitAddressApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function queryFind(): SpyCompanyUnitAddressQuery
    {
        return $this->getFactory()->getCompanyUnitAddressQuery();
    }
}
