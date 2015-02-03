<?php
return [
    'hydrators'=>[
     'factories'=>[
         'BsDirectory\Form\Hydrator\DirectoryProfile' => 'BsDirectory\Form\Hydrator\DirectoryProfileHydratorFactory',
          'BsDirectory\Form\Hydrator\SingleParentMultiChildCategory' => 'BsDirectory\Form\Hydrator\SingleParentMultiChildCategoryHydratorFactory'
    
         
     ] ,
        'aliases'=>[
            'bsdirectory_profile_hydrator'=>'BsDirectory\Form\Hydrator\DirectoryProfile',
            'bsdirectory_singleparentmultichildcategory_hydrator'=>'BsDirectory\Form\Hydrator\SingleParentMultiChildCategory'
        ]
    ],
    
    'form_elements' => [
        'invokables' => [
            'BsDirectory\Form\DirectoryProfile' => 'BsDirectory\Form\DirectoryProfile'
        ],
        'factories' => [
            'BsDirectory\Form\Fieldset\DirectoryProfile' => 'BsDirectory\Form\Fieldset\DirectoryProfileFactory'
        ],
        'aliases' => [
            'bsdirectory_profile_fieldset' => 'BsDirectory\Form\Fieldset\DirectoryProfile',
            'bsdirectory_profile_form' => 'BsDirectory\Form\\DirectoryProfile'
        ]
    ],
    'service_manager' => [
        'invokables' => [
            'BsDirectory\Model\Mapper\ODM\Mapper' => 'BsDirectory\Model\Mapper\ODM\Mapper',
            
          
            
        ],
        'factories' => [
            'BsDirectory\Model\Mapper\ODM\Repository\Factory\DirectoryProfileRepository' => 'BsDirectory\Model\Mapper\ODM\Repository\Factory\DirectoryProfileRepositoryFactory',
            'BsDirectory\Options\Options' => 'BsDirectory\Options\OptionsFactory',
            'BsDirectory\Service\Profile' => 'BsDirectory\Service\ProfileServiceFactory',
        ],
        'aliases' => [
            'bsdirectory_profile_odm_repository' => 'BsDirectory\Model\Mapper\ODM\Repository\Factory\DirectoryProfileRepository',
            'bsdirectory_odm_mapper' => 'BsDirectory\Model\Mapper\ODM\Mapper',
            'bsdirectory_options' => 'BsDirectory\Options\Options',
            'bsdirectory' => 'BsDirectory\Service\Profile'
        ]
    ],

    'router' => [
        'routes' => []
    ],
    'view_manager' => [
        'template_path_stack' => [
            'BsDirectory' => __DIR__ . '/../view'
        ]
    ],
    'doctrine' => [
        'driver' => [
            'odm_driver' => [
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'paths' => [
                    
                    __DIR__ . '/../src/BsDirectory/Model/Mapper/ODM/Document'
                ]
            ],
            'odm_default' => [
                'drivers' => [
                    'BsDirectory\Model\Mapper\ODM\Document' => 'odm_driver'
                ]
            ]
        ]
    ]
];
