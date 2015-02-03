<?php
namespace BsDirectory\Strategy;

use BsCategory\Form\Fieldset\SingleParentMultiChildCategoryFieldset;

class SingleParentMultiChildDirectoryCategoryStrategy implements DirectoryCategoryStrategyInterface
{

    const SINGLEPARENTMULTICHILD_FIELDSET_SERVICE = 'bscategory_singleparentmultichild_fieldset';

    /**
     *
     * @var SingleParentMultiChildCategoryFieldset
     */
    protected $fieldset;

    /**
     * @return string
     */
    public static function getFieldsetService()
    {
        return self::SINGLEPARENTMULTICHILD_FIELDSET_SERVICE;
    }

    /**
     *
     * @param SingleParentMultiChildCategoryFieldset $fieldset            
     */
    public function __construct(SingleParentMultiChildCategoryFieldset $fieldset)
    {
        
        $this->fieldset = $fieldset;
        
    }

    /*
     * (non-PHPdoc)
     * @see \BsCategory\Strategy\StrategyInterface::getFieldset()
     */
    public function getFieldset()
    {
        return $this->fieldset;
    }
}