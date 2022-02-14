<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM\QueryBuilderContainer;


class ExtendedRepository implements ObjectRepository {

	private $repository;

	public function __construct(ObjectRepository $repository, QueryBuilderContainer $queryBuilderContainer)
	{
		$this->repository = $repository;
		$repository->setRepositoryContainer($this);
		$this->queryBuilderContainer = $queryBuilderContainer;
		$this->queryBuilderContainer->setRepository($repository);
	}

	public function __call($name, $args)
	{
		return call_user_func_array([$this->repository, $name], $args);
	}

	public function getRepository() : ObjectRepository
	{
		return $this->repository;
	}

	public function addQueryBuilder($queryBuilder) : QueryBuilderContainer
	{
		return $this->queryBuilderContainer->addQueryBuilder($queryBuilder);

	}

	public function createQueryBuilder($alias, $indexBy = null)
	{
		$queryBuilder = $this->repository->createQueryBuilder($alias, $indexBy);
		if($queryBuilder instanceof QueryBuilder) return $this->addQueryBuilder($queryBuilder);
		
		return $queryBuilder;
	}

	public function find($id)
	{
		return $this->repository->find($id);
	}

    public function findAll()
    {
    	return $this->repository->findAll();
    }

    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
    	return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
    	return $this->repository->findOneBy($criteria);
    }

    public function getClassName()
    {
    	return $this->repository->getClassName();
    }

}