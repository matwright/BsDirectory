<?php
namespace BsDirectory\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use BsDirectory\Options\Options;
use BsBase\Model\Mapper\MapperInterface;
use Zend\Form\FormInterface;
use BsDirectory\Model\Mapper\DirectoryProfileInterface;
use BsDirectory\Model\Mapper\DirectoryProfileRepositoryInterface;
use Zend\Db\Adapter\Profiler\ProfilerInterface;

class ProfileService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    const DIRECTORY_CATEGORY_KEY = 'bsdirectory';

    private $options;

    private $mapper;

    public function __construct(Options $options, MapperInterface $mapper)
    {
        $this->options = $options;
        $this->mapper = $mapper;
    }

    /**
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     *
     * @return DirectoryProfileRepositoryInterface
     */
    public function getProfileRepository()
    {
        return $this->getMapper()->getRepository($this->getOptions()
            ->getObject());
    }

    /**
     * Fetch a single profile from the DB by ID
     *
     * @param string $id            
     * @return DirectoryProfileInterface
     */
    public function findProfile($id)
    {
        return $this->getProfileRepository()->find($id);
    }

    /**
     *
     * @param DirectoryProfileInterface $profile            
     */
    public function saveProfile(DirectoryProfileInterface $profile)
    {
        $this->mapper->save($profile);
    }

    /**
     *
     * @param array $params            
     */
    public function fetchLiteProfiles(array $params = array())
    {
        return $this->getProfileRepository()->findByParams($params, array(
            DirectoryProfileRepositoryInterface::DIRECTORY_REPOSITORY_MINIMAL
        ));
    }

    /**
     * Fetch a cursor containing public profile by criteria
     * @param array $params
     */
    public function fetchPublicProfiles(array $params = array())
    {
        return $this->getProfileRepository()->findByParams($params, array(
            DirectoryProfileRepositoryInterface::DIRECTORY_REPOSITORY_PUBLIC
        ));
    }

    /**
     *
     * @return MapperInterface
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     *
     * @return FormInterface
     */
    public function profileForm()
    {
        $form = $this->getServiceLocator()
            ->get('FormElementManager')
            ->get('bsdirectory_profile_form');
        
        return $form;
    }
}
