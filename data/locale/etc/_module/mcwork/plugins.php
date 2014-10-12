<?php
return array(
    'navigation' => array(
        'resource' => 'intranet',
        'name' => 'Navigation',
        'form' => array(
            1 => array(
                'spec' => array(
                    'name' => 'modulParams',
                    'required' => false,
                    'options' => array(
                        'label' => 'Navigation',
                        'empty_option' => 'Navigationsbaum',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebNavigations',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => 'title'
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulParams'
                    )
                )
            ),
            2 => array(
                'spec' => array(
                    'name' => 'modulDisplay',
                    'required' => false,
                    'options' => array(
                        'label' => 'Branch depth',
                        'empty_option' => 'Max depth',
                        'value_options' => array(
                            '1' => 'Level 1',
                            '2' => 'Level 2',
                            '3' => 'Level 3'
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulDisplay'
                    )
                )
            ),
            3 => array(
                'spec' => array(
                    'name' => 'modulFormat',
                    'required' => false,
                    'options' => array(
                        'label' => 'Format',
                        'empty_option' => 'No style',
                        'value_options' => array(
                            'navigationlist' => 'Standard List',
                            'navigationinline' => 'Inline List',
                            'topbarlist' => 'Topbar'
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulFormat'
                    )
                )
            ),
            4 => array(
                'spec' => array(
                    'name' => 'modulConfig',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulConfig'
                    )
                )
            ),
            5 => array(
                'spec' => array(
                    'name' => 'modulLink',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulLink'
                    )
                )
            )
        )
        
    ),
    
    'topbar' => array(
        'resource' => 'intranet',
        'name' => 'Topbar Navigation',
        'form' => array(
            1 => array(
                'spec' => array(
                    'name' => 'modulParams',
                    'required' => false,
                    'options' => array(
                        'label' => 'Navigation',
                        'empty_option' => 'Navigationsbaum',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebNavigations',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => 'title'
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulParams'
                    )
                )
            ),
            2 => array(
                'spec' => array(
                    'name' => 'modulDisplay',
                    'required' => false,
                    'options' => array(
                        'label' => 'Brand name',
                        'deco-row' => 'text'
                    ),
                    'type' => 'Text',
                    
                    'attributes' => array(
                        'id' => 'modulDisplay'
                    )
                )
            ),
            
            3 => array(
                'spec' => array(
                    'name' => 'modulLink',
                    'required' => false,
                    'options' => array(
                        'label' => 'Brand name link',
                        'deco-row' => 'text'
                    ),
                    'type' => 'Text',
                    
                    'attributes' => array(
                        'id' => 'modulLink'
                    )
                )
            ),
            
            4 => array(
                'spec' => array(
                    'name' => 'modulConfig',
                    'required' => false,
                    'options' => array(
                        'label' => 'Label menue mobile devices',
                        'deco-row' => 'text'
                    ),
                    'type' => 'Text',
                    
                    'attributes' => array(
                        'id' => 'modulConfig'
                    )
                )
            ),
            
            5 => array(
                'spec' => array(
                    'name' => 'modulFormat',
                    'required' => false,
                    'options' => array(
                        'label' => 'Format',
                        'empty_option' => 'No style',
                        'value_options' => array(
                            'topbar' => 'Responsive Topbar'
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulFormat'
                    )
                )
            )
        )
        
    ),
    
    'mediagroup' => array(
        'resource' => 'intranet',
        'name' => 'MediaGroup',
        
        'form' => array(
            1 => array(
                'spec' => array(
                    'name' => 'modulParams',
                    'required' => false,
                    'options' => array(
                        'label' => 'Dateigruppen',
                        'empty_option' => 'Dateigruppe',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebMediaGroup',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => 'groupName'
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulParams'
                    )
                )
            ),
            2 => array(
                'spec' => array(
                    'name' => 'modulFormat',
                    'required' => false,
                    'options' => array(
                        'label' => 'Format',
                        'empty_option' => 'No style',
                        'value_options' => array(
                            'imageslider' => 'Slider',
                            'contentslider' => 'Contentslider'
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulFormat'
                    )
                )
            ),
            3 => array(
                'spec' => array(
                    'name' => 'modulDisplay',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulDisplay'
                    )
                )
            ),
            4 => array(
                'spec' => array(
                    'name' => 'modulConfig',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulConfig'
                    )
                )
            ),
            5 => array(
                'spec' => array(
                    'name' => 'modulLink',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulLink'
                    )
                )
            )
        )
        
    )
    ,
    'forms' => array(
        'resource' => 'intranet',
        'name' => 'Forms',
        
        'form' => array(
            1 => array(
                'spec' => array(
                    'name' => 'modulParams',
                    'required' => false,
                    'options' => array(
                        'label' => 'Formulare',
                        'empty_option' => 'Formular',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebForms',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => 'headline'
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulParams'
                    )
                )
            ),
            2 => array(
                'spec' => array(
                    'name' => 'modulFormat',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulFormat'
                    )
                )
            ),
            3 => array(
                'spec' => array(
                    'name' => 'modulDisplay',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulDisplay'
                    )
                )
            ),
            4 => array(
                'spec' => array(
                    'name' => 'modulConfig',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulConfig'
                    )
                )
            ),
            5 => array(
                'spec' => array(
                    'name' => 'modulLink',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulLink'
                    )
                )
            )
        )
        
    )
    ,
    'maps' => array(
        'resource' => 'intranet',
        'name' => 'Maps',
        'form' => array(
            1 => array(
                'spec' => array(
                    'name' => 'modulParams',
                    'required' => false,
                    'options' => array(
                        'label' => 'Maps',
                        'empty_option' => 'Maps',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebMaps',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => 'headline'
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
                    
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'modulParams'
                    )
                )
            ),
            2 => array(
                'spec' => array(
                    'name' => 'modulFormat',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulFormat'
                    )
                )
            ),
            3 => array(
                'spec' => array(
                    'name' => 'modulDisplay',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulDisplay'
                    )
                )
            ),
            4 => array(
                'spec' => array(
                    'name' => 'modulConfig',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulConfig'
                    )
                )
            ),
            5 => array(
                'spec' => array(
                    'name' => 'modulLink',
                    'required' => false,
                    'options' => array(),
                    'type' => 'Hidden',
                    
                    'attributes' => array(
                        'id' => 'modulLink'
                    )
                )
            )
        )
        
    )
    
);