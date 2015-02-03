<?php
namespace BsDirectory\Model\Mapper\ODM\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use BsCategory\Model\Mapper\ODM\Document\CategorizedInterfaceTrait;
use BsCategory\Model\Mapper\CategorizedInterface;
/**
 * @author matwright
 * @ODM\MappedSuperclass
 */
abstract class AbstractCategorizedDirectoryProfile extends AbstractDirectoryProfile implements CategorizedInterface
{
    use CategorizedInterfaceTrait;
    
}