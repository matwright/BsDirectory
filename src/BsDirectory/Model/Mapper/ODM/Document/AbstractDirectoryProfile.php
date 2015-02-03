<?php
namespace BsDirectory\Model\Mapper\ODM\Document;

use BsDirectory\Model\Mapper\DirectoryProfileInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use BsBase\Model\Mapper\ODM\Document\AbstractDocument;

/**
 *
 * @author matwright
 *         @ODM\MappedSuperclass
 */
abstract class AbstractDirectoryProfile extends AbstractDocument implements DirectoryProfileInterface
{
    use DirectoryProfileInterfaceTrait;
}