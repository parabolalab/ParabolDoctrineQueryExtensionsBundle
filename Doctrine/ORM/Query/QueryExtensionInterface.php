<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM\Query;

interface QueryExtensionInterface {

	public function apply($repository, $queryBuilder) : void;
	
}

