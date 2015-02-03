<?php
namespace BsDirectory\Model\Mapper\ODM;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use BsBase\Model\Mapper\MapperInterface;

class Mapper implements ServiceLocatorAwareInterface, MapperInterface
{
    use \Zend\ServiceManager\ServiceLocatorAwareTrait,\BsBase\Model\Mapper\ODM\ODMMapperTrait;

   
}