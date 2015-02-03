<?php
namespace BsDirectory\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use BsDirectory\Model\Mapper\DirectoryProfileInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use BsDirectory\Options\Options;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use BsDirectory\Form\Hydrator\DirectoryProfileHydrator;

class DirectoryProfile extends Fieldset implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{
    
    use ServiceLocatorAwareTrait;
    use EventManagerAwareTrait;

    /**
     *
     * @var Options
     */
    private $directoryOptions;

    /**
     *
     * @var array
     */
    private $statusOptions = [
        DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_AWAITING_AUTH => DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_AWAITING_AUTH,
        DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_EXPIRED => DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_EXPIRED,
        DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_PAUSED => DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_PAUSED,
        DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_PUBLISHED => DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_PUBLISHED
    ];

    /**
     *
     * @param Options $directoryOptions            
     */
    public function __construct(Options $directoryOptions,DirectoryProfileHydrator $hydrator)
    {
        // must call parent construct for iteratory to be instantiated
        parent::__construct();
        $this->directoryOptions = $directoryOptions;
        $this->setHydrator($hydrator);
        $this->setName('profile');
        $this->setLabel('profile');
        $this->add((new Text('name'))->setLabel('Name'));
        $status = (new Select('status'))->setLabel('Status');
        $status->setValueOptions($this->statusOptions);
        $this->add($status);
    }

    public function init()
    {
        $this->getEventManager()->trigger(__FUNCTION__, $this);
    }
}