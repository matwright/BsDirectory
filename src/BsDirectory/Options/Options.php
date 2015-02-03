<?php
namespace BsDirectory\Options;

use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    
    private $object;

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function getMapper()
    {
        return $this->mapper;
    }

    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
    }

    public function getAddressStrategy()
    {
        return $this->addressStrategy;
    }

    public function setAddressStrategy($addressStrategy)
    {
        $this->addressStrategy = $addressStrategy;
    }

    public function getCategoryStrategy()
    {
        return $this->categoryStrategy;
    }

    public function setCategoryStrategy($categoryStrategy)
    {
        $this->categoryStrategy = $categoryStrategy;
    }
}