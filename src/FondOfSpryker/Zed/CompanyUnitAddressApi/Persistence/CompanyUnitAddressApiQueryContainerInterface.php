<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence;

use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;

interface CompanyUnitAddressApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function queryFind(): SpyCompanyUnitAddressQuery;
}
