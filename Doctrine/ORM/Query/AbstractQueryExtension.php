<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM\Query;

use Doctrine\ORM\Query\Filter\SQLFilter;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM\Query\ModularFilterInterface;

abstract class AbstractQueryExtension implements QueryExtensionInterface {

	abstract public function apply($repository, $queryBuilder) : void;

}

