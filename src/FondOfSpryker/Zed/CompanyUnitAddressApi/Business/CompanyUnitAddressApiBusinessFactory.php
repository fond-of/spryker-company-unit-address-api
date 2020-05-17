<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business;

use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface getQueryContainer()
 */
class CompanyUnitAddressApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface
     */
    public function createCompanyUnitAddressApi(): CompanyUnitAddressApiInterface
    {
        return new CompanyUnitAddressApi(
            $this->getApiQueryContainer(),
            $this->getApiQueryBuilderQueryContainer(),
            $this->getQueryContainer(),
            $this->getCompanyFacade(),
            $this->createTransferMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyUnitAddressApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer(): CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected function getCompanyFacade(): CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface
     */
    protected function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface
     */
    public function createCompanyUnitAddressApiValidator(): CompanyUnitAddressApiValidatorInterface
    {
        return new CompanyUnitAddressApiValidator();
    }
}
