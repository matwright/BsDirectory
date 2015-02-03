<?php
namespace BsDirectory\Form\Hydrator;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Util\Debug;
class DirectoryProfileHydrator extends DoctrineObject
{
    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
    }
    
    /* (non-PHPdoc)
     * @see \DoctrineModule\Stdlib\Hydrator\DoctrineObject::extract()
     */
    public function extract($developerEntity)
    {
        $data = parent::extract($developerEntity);
        return $data;
    }
    
    /* (non-PHPdoc)
     * @see \DoctrineModule\Stdlib\Hydrator\DoctrineObject::hydrate()
     */
    public function hydrate(array $data, $object)
    {
   
        $object=parent::hydrate($data, $object);

        return $object;
    }
}