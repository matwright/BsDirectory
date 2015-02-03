<?php
namespace BsDirectory\Model\Mapper\ODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use BsCategory\Model\Mapper\CategorizedInterface;
use BsCategory\Model\Mapper\CategorizedObjectInterface;

/**
 *
 * @author matwright
 *         @ODM\MappedSuperclass
 *        
 *        
 */
abstract class AbstractSingleParentMultiChildCategorizedDirectoryProfile extends AbstractDirectoryProfile implements CategorizedObjectInterface
{
    /**
     * 
     * @var CategorizedInterface
     * @ODM\EmbedOne(targetDocument="BsDirectory\Model\Mapper\ODM\Document\SingleParentMultiChildDirectoryCategory");
     */
    protected $category;

    /**
     *
     * @return CategorizedInterface $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     *
     * @param CategorizedInterface $category           
     */
    public function setCategory(CategorizedInterface $category)
    {
        $this->category=$category;
        return $this;
    }
}