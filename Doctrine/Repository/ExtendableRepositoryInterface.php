<?php 

namespace Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository\ExtendedRepository;

interface ExtendableRepositoryInterface {

  public function setRepositoryContainer( ?ExtendedRepository $repositoryContainer ) : self;
  
  public function getRepositoryContainer() : ?ExtendedRepository;
  
  
	
}

