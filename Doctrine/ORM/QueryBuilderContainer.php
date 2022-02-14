<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM;

use Doctrine\ORM\{Query, QueryBuilder};
use Doctrine\Persistence\ObjectRepository;


class QueryBuilderContainer {

	private $queryBuilder;
	private $repository;
	private $doctrineQueryExtensions;


	function __construct( iterable $doctrineQueryExtensions )
	{
		$this->doctrineQueryExtensions = $doctrineQueryExtensions;
	}	

	public function __call($name, $args)
	{
		$result = call_user_func_array([$this->queryBuilder, $name], $args);
		
		return ($result instanceof QueryBuilder) ? $this : $result;
	}

	public function addQueryBuilder( QueryBuilder $queryBuilder ) : self
	{
		$this->queryBuilder = $queryBuilder;
		
		return $this;
	}

	public function getQueryBuilder() : QueryBuilder
	{
		return $this->queryBuilder;
	}

	public function setRepository( ObjectRepository $repository ) : self
	{
		$this->repository = $repository;
		
		return $this;
	}

	public function getRepository() : ObjectRepository {
		return $this->repository;
	}

	public function getQuery() : Query
    {
    	foreach($this->doctrineQueryExtensions as $exension)
    	{
    		$exension->apply($this->getRepository(), $this->queryBuilder);
    	}

        return $this->queryBuilder->getQuery();
    }

	
}