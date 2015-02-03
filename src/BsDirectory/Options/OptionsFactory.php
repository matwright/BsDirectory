<?php
namespace BsDirectory\Options;

use Zend\ServiceManager\FactoryInterface;

class OptionsFactory implements FactoryInterface
{

    /*
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $directoryOptions = $serviceLocator->get('config');
        return new Options($directoryOptions['bsdirectory']);
        
    }
}