<?php
namespace BsDirectory\Model\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use BsCategory\Model\Mapper\CategoryInterface;

/**
 * Interface corresponding to all repositories
 */
interface DirectoryProfileRepositoryInterface extends ObjectRepository
{

    const DIRECTORY_REPOSITORY_MINIMAL = 1;

    const DIRECTORY_REPOSITORY_PUBLIC = 2;
    

    /**
     *
     * @param CategoryInterface $category            
     */
    public function findByCategory(CategoryInterface $category);

    /**
     *
     * @param array $params            
     * @param array $flags            
     */
    public function findByParams(array $params = array(), array $flags = array());
}