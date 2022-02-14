<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository;

use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory as DoctrineContainerRepositoryFactory;
use Psr\Container\ContainerInterface;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository\ExtendedRepository;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\ORM\QueryBuilderContainer;

final class ContainerRepositoryFactory implements RepositoryFactory
{
    
    private $container;
    private $doctrineQueryExtensions;
    private $factory;

    public function __construct(ContainerInterface $container, iterable $doctrineQueryExtensions)
    {

    	$this->container = $container;
        $this->doctrineQueryExtensions = $doctrineQueryExtensions;
        $this->factory = new DoctrineContainerRepositoryFactory($container);
    }

   
    public function getRepository(EntityManagerInterface $entityManager, $entityName): ObjectRepository
    {
        $repository = $this->factory->getRepository($entityManager, $entityName);

        if($repository instanceof ExtendableRepositoryInterface)
        {

        	$repository = new ExtendedRepository(
                    $this->factory->getRepository($entityManager, $entityName), 
                    new QueryBuilderContainer($this->doctrineQueryExtensions )
            );

        }

    	return $repository;
    }

    
}


