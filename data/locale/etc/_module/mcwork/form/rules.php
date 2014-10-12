<?php
return array(
    'fieldtypes' => array(
        'std' => array(),
        'entity' => 'Contentinum\Entity\FieldTypes',
        'configure' => array(),
        'elements' => array(
            'typescope' => array(
                'monitor' => array(
                    'conditions' => array(
                        'mclenght' => array(
                            'min' => 3,
                            'operator' => '>',
                            'error' => 'not_less_than'
                        )
                    ),
                    'remote' => '/mcwork/medias/application/entryexists',
                    'messages' => array(
                        'success' => 'entrynoexists',
                        'error' => 'entryexists'
                    ),
                    'datas' => array(
                        'entity' => 'Contentinum\Entity\FieldTypes',
                        'field' => 'typescope',
                        'value' => false,
                        'exclude' => false
                    )
                )
            )
        )
    ),
    'fieldmetas' => array(
        'std' => array(),
        'entity' => 'Contentinum\Entity\FieldTypeMetas',
        'configure' => array(
            'url_back' => '/mcwork/fieldmetas/category/:fieldTypes',
            'url_placeholder' => ':fieldTypes',
            'url_source_element' => '#fieldTypes',
            'url_source_std' => 1
     
        ),
        'elements' => array(
            'datascope' => array(
                'monitor' => array(
                    'conditions' => array(
                        'mclenght' => array(
                            'min' => 3,
                            'operator' => '>',
                            'error' => 'not_less_than'
                        )
                    ),
                    'remote' => '/mcwork/medias/application/entryexists',
                    'messages' => array(
                        'success' => 'entrynoexists',
                        'error' => 'entryexists'
                    ),
                    'datas' => array(
                        'entity' => 'Contentinum\Entity\FieldTypeMetas',
                        'field' => 'datascope',
                        'value' => false,
                        'exclude' => false
                    )
                )
            )
        )
    ),
    'mediacategories' => array(
        'std' => array(
            '#webMediagroupId' => array(
                'val' => '_leave',
            ),
            '#resource' => array(
                'val' => 'index'
            )
        ),
        'entity' => 'Contentinum\Entity\WebMediaCategories',
        'categories' => array(
            'category' => 'media',
            'element' => '#webMediagroupId',
            'active_element' => '#webMediasId',
            'categoryname' => 'Categories\Media',
            'url' => '/mcwork/medias/application/groupcategories'
        ),
        'configure' => array(
            'url_back' => '/mcwork/mediacategories/category/:webMediagroupId',
            'url_placeholder' => ':webMediagroupId',
            'url_source_element' => '#webMediagroupId',
            'url_source_std' => 1
        ),
        'elements' => array(
            'webMediasId' => array(
                'monitor' => array(
                    'conditions' => array(
                    ),
                    'remote' => '/mcwork/medias/application/entryexists',
                    'messages' => array(
                        'success' => 'entrynoexists',
                        'error' => 'entryexists'
                    ),
                    'datas' => array(
                        'entity' => 'Contentinum\Entity\WebMediaCategories',
                        'field' => 'webMediasId',
                        'value' => false,
                        'exclude' => false
                    )
                )
            )
        )        
    ),
    'contribution' => array(
        'std' => array(
            '#resource' => array(
                'val' => 'index'
            ),
            '#publish' => array(
                'val' => 'yes'
            )
        ),
        'entity' => 'Contentinum\Entity\WebContent'
    ),
    'navigation' => array(
        'std' => array(
            '#tplAssign' => array(
                'val' => 'STANDARD'
            ),
            '#resource' => array(
                'val' => 'index'
            ),
            '#tags' => array(
                'val' => 'h2'
            )
        ),
        'entity' => 'Contentinum\Entity\WebNavigation'
    ),
    'navigationcategories' => array(
        'std' => array(
            '#webNavigations' => array(
                'val' => '_leave',
            ),    
            '#publish' => array(
                'val' => 'yes'
            ),        
            '#resource' => array(
                'val' => 'index'
            )
        ),
        'entity' => 'Contentinum\Entity\WebNavigationTree',
        'configure' => array(
            'url_back' => '/mcwork/menue/category/:webNavigations',
            'url_placeholder' => ':webNavigations',
            'url_source_element' => '#webNavigations',
            'url_source_std' => 1
        )
    ),
    
    'formcategories' => array(
        'std' => array(
            '#webForms' => array(
                'val' => '_leave',
            ),
            '#webMedias' => array(
                'val' => '1',
            ),         
            '#resource' => array(
                'val' => 'index'
            )
        ),
        'entity' => 'Contentinum\Entity\WebFormsField',
        'configure' => array(
            'url_back' => '/mcwork/formfields/category/:webForms',
            'url_placeholder' => ':webForms',
            'url_source_element' => '#webForms',
            'url_source_std' => 1
        )
    ),  
    'mapcategories' => array(
        'std' => array(
            '#webMaps' => array(
                'val' => '_leave',
            ),
            '#webMedias' => array(
                'val' => '1',
            ),
        ),
        'entity' => 'Contentinum\Entity\WebMapsData',
        'configure' => array(
            'url_back' => '/mcwork/mapdata/category/:webMaps',
            'url_placeholder' => ':webMaps',
            'url_source_element' => '#webMaps',
            'url_source_std' => 1
        )
    ), 
    'accountcategories' => array(
        'std' => array(
            '#accounts' => array(
                'val' => '_leave',
            ),
        ),
        'entity' => 'Contentinum\Entity\Accounts',
        'configure' => array(
            'url_back' => '/mcwork/contacts/category/:accounts',
            'url_placeholder' => ':accounts',
            'url_source_element' => '#accounts',
            'url_source_std' => 0
        )
    ),         
    'pages' => array(
        'std' => array(
            '#webPreferences' => array(
                'val' => '_default'
            ),
            '#language' => array(
                'val' => 'de'
            ),
            '#resource' => array(
                'val' => 'index'
            ),
            '#robots' => array(
                'val' => 'index,follow'
            ),
            '#publish' => array(
                'val' => 'yes'
            )
        ),
        'entity' => 'Contentinum\Entity\WebPagesParameter'
    ),
    'preferences' => array(
        'std' => array(
            '#robots' => array(
                'val' => 'index,follow'
            ),
            '#standardDomain' => array(
                'val' => 'no'
            ),
            '#hostId' => array(
                'val' => '_default'
            ),
            '#charset' => array(
                'val' => 'utf-8'
            ),
            '#locale' => array(
                'val' => 'de_DE'
            )
        ),
        'entity' => 'Contentinum\Entity\WebPreferences'
    ),
    'usercategories' => array(
        'std' => array(),
        'entity' => 'Contentinum\Entity\Users5',
        'configure' => array(),
        'elements' => array(
            'username' => array(
                'monitor' => array(
                    'conditions' => array(
                        'mclenght' => array(
                            'min' => 6,
                            'operator' => '>',
                            'error' => 'not_less_than'
                        )
                    ),
                    'remote' => '/mcwork/medias/application/entryexists',
                    'messages' => array(
                        'success' => 'entrynoexists',
                        'error' => 'entryexists'
                    ),
                    'datas' => array(
                        'entity' => 'Contentinum\Entity\Users5',
                        'field' => 'username',
                        'value' => false,
                        'exclude' => false
                    )
                )
            )
        )
    ),    
);