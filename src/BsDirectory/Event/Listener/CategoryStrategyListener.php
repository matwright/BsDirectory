<?php
namespace BsDirectory\Event\Listener;

use Zend\EventManager\EventInterface;
use BsDirectory\Form\Fieldset\DirectoryProfile;
use Zend\Form\FieldsetInterface;
use BsDirectory\Strategy\DirectoryCategoryStrategyInterface;
use BsDirectory\Form\Hydrator\HydratorException;
use BsCategory\Strategy\StrategyInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Listens to new
 *
 * @author matwright
 *        
 */
class CategoryStrategyListener
{
    
    use ServiceLocatorAwareTrait;

    /**
     *
     * @var StrategyInterface
     */
    private $strategy;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);
    }

    /**
     *
     * @param EventInterface $e            
     * @return DirectoryProfile
     */
    public function __invoke(EventInterface $e)
    {
        $this->strategy = $e->getTarget();
        
        if (! $this->strategy instanceof DirectoryCategoryStrategyInterface) {
            return;
        }
        $fieldset = $this->strategy->getFieldset();
        $this->setHydrator($fieldset);
        return $this->strategy;
    }

    /**
     *
     * @param FieldsetInterface $fieldset            
     * @throws HydratorException
     */
    private function setHydrator(FieldsetInterface $fieldset)
    {
        $class = get_class($this->strategy);
        switch ($class) {
            case ('BsDirectory\Strategy\SingleParentMultiChildDirectoryCategoryStrategy'):
                
                $fieldset->setHydrator($this->getServiceLocator()
                    ->get('HydratorManager')
                    ->get('bsdirectory_singleparentmultichildcategory_hydrator'));

                break;
            default:
                throw new HydratorException('Error class ' . $class . ' not a recognized directory category strategy.');
                break;
        }
    }
}