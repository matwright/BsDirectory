<?php
namespace BsDirectory\Model\Mapper\ODM\Document;


use BsCategory\Model\Mapper\ODM\Document\AbstractSingleParentMultiChildCategory;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
/**
 *
 * @author matwright
 *         @ODM\EmbeddedDocument
 */
class SingleParentMultiChildDirectoryCategory extends AbstractSingleParentMultiChildCategory{

    /**
     * @ODM\ReferenceMany(name="DirectoryCategory",targetDocument="Category",cascade="persist",sort={"name":"asc"});
     */
    protected $category;

    /**
     *
     * @var CategoryInterface @ODM\ReferenceOne(targetDocument="Category")
     */
    protected $parent;

    public function __toString()
    {
        return $this->getParent()->getName();
    }
}