<?php
namespace BsDirectory\Form\Fieldset;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DirectoryProfileFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->getServiceLocator()->get('bsdirectory_options');
        return new DirectoryProfile($options,$serviceLocator->getServiceLocator()->get('HydratorManager')->get('bsdirectory_profile_hydrator'));
    }
}