<?php
namespace BsDirectory\Model\Mapper\ODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait DirectoryProfileInterfaceTrait

{

    /**
     *
     * @var string @ODM\Id
     */
    private $id;

    /**
     *
     * @var string @ODM\String
     */
    private $name;

    /**
     *
     * @var string @ODM\String
     */
    private $status;

    /**
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param string $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @param string $name            
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $status            
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return $this->getName();
    }
}