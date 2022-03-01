<?php

namespace Parabol\DoctrineQueryExtensionsBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Parabol\DoctrineQueryExtensionsBundle\Doctrine\Repository\ExtendedRepository;


class EntityTypeExtension  extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [EntityType::class];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('query_builder', function(ExtendedRepository $er){ return $er->createQueryBuilder('p')->getQueryBuilder(); });
    }
}