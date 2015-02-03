<?php
namespace BsDirectory\Model\Mapper\ODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use BsCategory\Model\Mapper\ODM\Document\AbstractCategory;

/**
 *
 * @author matwright
 *         @ODM\Document(
 *         collection="DirectoryCategory",
 *         repositoryClass="BsCategory\Model\Mapper\ODM\Repository\CategoryRepository"
 *         )
 *         @ODM\Index(keys={"name"="asc"})
 *         
 */
class Category extends AbstractCategory
{

    /**
     *
     * @var Category @ODM\ReferenceOne(targetDocument="BsDirectory\Model\Mapper\ODM\Document\Category")
     */
    protected $parent;

    /**
     *
     * @var ArrayCollection @ODM\ReferenceMany(strategy="addToSet",targetDocument="BsDirectory\Model\Mapper\ODM\Document\Category",cascade="persist",sort={"name":"asc"})
     */
    protected $children;

   
}