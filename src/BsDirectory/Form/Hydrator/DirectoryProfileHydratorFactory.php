<?php
namespace BsDirectory\Form\Hydrator;

use Zend\ServiceManager\FactoryInterface;

class DirectoryProfileHydratorFactory implements FactoryInterface
{

    /*
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->getServiceLocator()
            ->get('bsdirectory')
            ->getMapper()
            ->getInstance();
        return new DirectoryProfileHydrator($objectManager);
    }
}