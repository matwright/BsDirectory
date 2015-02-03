<?php
namespace BsDirectory\Service;

use Zend\ServiceManager\FactoryInterface;
class ProfileServiceFactory implements FactoryInterface
{
 /* (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $options=$serviceLocator->get('bsdirectory_options');
        if($serviceLocator->has($options->getMapper())){
            $mapper=$serviceLocator->get($options->getMapper());
        }else{
            $mapperClass=$options->getMapper();
            $mapper=new $mapperClass;
        }
        return new ProfileService($options,$mapper);
        
    }

}