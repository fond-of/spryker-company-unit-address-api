<?php

namespace FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Model;

use FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyUnitAddressApi implements CompanyUnitAddressApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface
     */
    protected $companyUnitAddressApiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @param \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiQueryContainerInterface $companyUnitAddressApiQueryContainer
     * @param \FondOfSpryker\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     * @param \FondOfSpryker\Zed\CompanyUnitAddressApi\Business\Mapper\TransferMapperInterface $transferMapper
     */
    public function __construct(
        CompanyUnitAddressApiToApiQueryContainerInterface $apiQueryContainer,
        CompanyUnitAddressApiToApiQueryBuilderQueryContainerInterface $apiQueryBuilderQueryContainer,
        CompanyUnitAddressApiQueryContainerInterface $companyUnitAddressApiQueryContainer,
        CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade,
        TransferMapperInterface $transferMapper
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->apiQueryBuilderQueryContainer = $apiQueryBuilderQueryContainer;
        $this->companyUnitAddressApiQueryContainer = $companyUnitAddressApiQueryContainer;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
        $this->transferMapper = $transferMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())->fromArray($data, true);
        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->create($companyUnitAddressTransfer);

        if (!$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyUnitAddressResponseTransfer->getMessages() as $error) {
                $errors[] = $error->getText();
            }

            throw new EntityNotSavedException('Could not add company unit address: ' . implode(',', $errors));
        }

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer
        );

        return $this->apiQueryContainer->createApiItem(
            $companyUnitAddressTransfer,
            $companyUnitAddressTransfer->getIdCompanyUnitAddress()
        );
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyUnitAddress): ApiItemTransfer
    {
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer
        );

        if ($companyUnitAddressTransfer->getAddress1() === null) {
            throw new EntityNotFoundException(sprintf(
                'Company unit address not found for id %s',
                $idCompanyUnitAddress
            ));
        }

        return $this->apiQueryContainer->createApiItem($companyUnitAddressTransfer, $idCompanyUnitAddress);
    }

    /**
     * @param int $idCompanyUnitAddress
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyUnitAddress, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer
        );

        if ($companyUnitAddressTransfer->getAddress1() === null) {
            throw new EntityNotFoundException(sprintf('Company unit address not found: %s', $idCompanyUnitAddress));
        }

        $data = (array)$apiDataTransfer->getData();
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->fromArray($data, true)
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->update($companyUnitAddressTransfer);

        if (!$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            $errors = [];

            foreach ($companyUnitAddressResponseTransfer->getMessages() as $message) {
                $errors[] = $message->getText();
            }

            throw new EntityNotSavedException('Could not update company unit address: ' . implode(',', $errors));
        }

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer
        );

        return $this->apiQueryContainer->createApiItem(
            $companyUnitAddressTransfer,
            $companyUnitAddressTransfer->getIdCompanyUnitAddress()
        );
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyUnitAddress): ApiItemTransfer
    {
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $this->companyUnitAddressFacade->delete($companyUnitAddressTransfer);

        return $this->apiQueryContainer->createApiItem([], $idCompanyUnitAddress);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);
        $collection = $this->transferMapper->toTransferCollection($query->find()->toArray());

        foreach ($collection as $k => $companyUnitAddressApiTransfer) {
            $collection[$k] = $this->get($companyUnitAddressApiTransfer->getIdCompanyUnitAddress())->getData();
        }

        $apiCollectionTransfer = $this->apiQueryContainer->createApiCollection($collection);
        $apiCollectionTransfer = $this->addPagination($query, $apiCollectionTransfer, $apiRequestTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer): ModelCriteria
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);
        $query = $this->companyUnitAddressApiQueryContainer->queryFind();
        $query = $this->apiQueryBuilderQueryContainer->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected function buildApiQueryBuilderQuery(ApiRequestTransfer $apiRequestTransfer): ApiQueryBuilderQueryTransfer
    {
        $columnSelectionTransfer = $this->buildColumnSelection();

        $apiQueryBuilderQueryTransfer = (new ApiQueryBuilderQueryTransfer())
            ->setApiRequest($apiRequestTransfer)
            ->setColumnSelection($columnSelectionTransfer);

        return $apiQueryBuilderQueryTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer
     */
    protected function buildColumnSelection(): PropelQueryBuilderColumnSelectionTransfer
    {
        $columnSelectionTransfer = new PropelQueryBuilderColumnSelectionTransfer();
        $tableColumns = SpyCompanyUnitAddressTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = (new PropelQueryBuilderColumnTransfer())
                ->setName(SpyCompanyUnitAddressTableMap::TABLE_NAME . '.' . $columnAlias)
                ->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

        return $columnSelectionTransfer;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiCollectionTransfer $apiCollectionTransfer
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected function addPagination(
        ModelCriteria $query,
        ApiCollectionTransfer $apiCollectionTransfer,
        ApiRequestTransfer $apiRequestTransfer
    ): ApiCollectionTransfer {
        $query->setOffset(0)
            ->setLimit(-1);

        $total = $query->count();
        $page = $apiRequestTransfer->getFilter()->getLimit() ? ($apiRequestTransfer->getFilter()->getOffset() / $apiRequestTransfer->getFilter()->getLimit() + 1) : 1;
        $pageTotal = ($total && $apiRequestTransfer->getFilter()->getLimit()) ? (int)ceil($total / $apiRequestTransfer->getFilter()->getLimit()) : 1;

        if ($page > $pageTotal) {
            throw new NotFoundHttpException('Out of bounds.', null, ApiConfig::HTTP_CODE_NOT_FOUND);
        }

        $apiPaginationTransfer = (new ApiPaginationTransfer())
            ->setItemsPerPage($apiRequestTransfer->getFilter()->getLimit())
            ->setPage($page)
            ->setTotal($total)
            ->setPageTotal($pageTotal);

        $apiCollectionTransfer->setPagination($apiPaginationTransfer);

        return $apiCollectionTransfer;
    }
}
