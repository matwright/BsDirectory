<?php
namespace BsDirectory\Model\Mapper\ODM\Repository\Factory;

use Zend\ServiceManager\FactoryInterface;
use BsDirectory\Model\Mapper\ProfileRepositoryInterface;

/**
 * Repository Factory using 'BsDirectory\Model\Mapper\ODM\Repository\DirectoryProfileRepository' repository by default
 */
class DirectoryProfileRepositoryFactory implements FactoryInterface
{
    
    /*
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */ 
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $dm = $serviceLocator->get('doctrine.documentmanager.odm_default');
        $repository = $dm->getRepository($serviceLocator->get('bsdirectory_options')->getEntity());
        if (! $repository instanceof ProfileRepositoryInterface) {
            throw new \Exception('Configured repository must be instance of ProfileRepositoryInterface');
        }
        return $repository;
    }
}