<?php
namespace BsDirectory\Form;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Form\Form;
use BsDirectory\BsDirectoryException;
use BsGeo\Model\Mapper\AddressAbledInterface;
use BsImmoManager\Form\AddressFieldset;
use BsCategory\Model\Mapper\CategorizedObjectInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Form\Element\Submit;
use BsContact\Model\Mapper\ContactableInterface;
use Zend\Form\FieldsetInterface;

/**
 *
 * @author matwright
 *        
 */
class DirectoryProfile extends Form implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{
    use ServiceLocatorAwareTrait;
    use EventManagerAwareTrait;

    /**
     *
     * @var Options
     */
    private $moduleOptions;

    /**
     *
     * @return DirectoryProfile
     */
    public function getProfileFieldset()
    {
        return $this->getServiceLocator()->get('bsdirectory_profile_fieldset');
    }

    /*
     * (non-PHPdoc)
     * @see \Zend\Form\Element::init()
     */
    public function init()
    {
        $this->moduleOptions = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('bsdirectory_options');
        $objectClass = $this->moduleOptions->getObject();
        
        $profileFieldset = $this->getProfileFieldset();
        $profileFieldset->setObject(new $objectClass());
        $this->setBaseFieldset($profileFieldset);
        
        $this->setName('directory');
        $this->setLabel('directory');
        
        if ($profileFieldset->getObject() instanceof CategorizedObjectInterface) {
            $profileFieldset->add($this->getCategoryFieldset());
        }
        
        if ($profileFieldset->getObject() instanceof ContactableInterface) {
            $profileFieldset->add($this->getContactFieldset());
        }
        
        if ($profileFieldset->getObject() instanceof AddressAbledInterface) {
            $profileFieldset->add($this->getAddressFieldset());
        }
        
        $this->add($profileFieldset);
        
        $this->getEventManager()->trigger(__FUNCTION__, $this);
        
        $this->add((new Submit('submit'))->setValue('Save profile'));
    }

    /**
     * @return FieldsetInterface
     */
    private function getContactFieldset()
    {
        return $this->getServiceLocator()->get('bscontact_contact_fieldset');
    }

    /**
     *
     * @throws BsDirectoryException
     * @return AddressFieldset
     */
    private function getAddressFieldset()
    {
        $addressStrategyName = $this->moduleOptions->getAddressStrategy();
        if (! $addressStrategyName) {
            throw new BsDirectoryException('an address strategy must be set in config when using a address abled profile');
        }
        $addressFieldset = $this->getServiceLocator()
            ->getServiceLocator()
            ->get($addressStrategyName)
            ->getFieldset();
        return $addressFieldset;
    }

    /**
     *
     * @throws BsDirectoryException
     * @return FieldsetInterface
     */
    private function getCategoryFieldset()
    {
        $categoryStrategyName = $this->moduleOptions->getCategoryStrategy();
        if (! $categoryStrategyName) {
            throw new BsDirectoryException('a category strategy must be set in config when using a categorized profile');
        }
        $categoryFieldset = $this->getServiceLocator()
            ->getServiceLocator()
            ->get($categoryStrategyName)
            ->getFieldset();
        
        $mapper = $this->getServiceLocator()
            ->getServiceLocator()
            ->get('bsdirectory')
            ->getMapper();
        $categoryObject = $mapper->getObject(str_replace('CategoryStrategy', 'Category', $categoryStrategyName));
        $categoryFieldset->setObject($categoryObject);
        $categoryFieldset->setCategoryTargetClass(get_class($mapper->getObject('Category')));
        return $categoryFieldset;
    }
}