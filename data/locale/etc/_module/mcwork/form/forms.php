<?php
return array(
    
    'movesubmenue' => array(
        'form' => array(
        
            1 => array(
                'spec' => array(
                    'name' => 'movesub',
                    'required' => false,
                    'options' => array(
                        'label' => 'Navigation',
                        'empty_option' => 'Navigationsbaum',
                        'value_function' => array(
                            'method' => 'ajax',
                            'url' => '/mcwork/medias/application/module',
                            'data' => array(
                                'entity' => 'Contentinum\Entity\WebNavigationsTree',
                                'prepare' => 'select',
                                'value' => 'id',
                                'label' => array('webPages' =>'label', 'webNavigations' => 'title')
                            )
                        ),
                        'deco-row' => 'text'
                    ),
                    'type' => 'Select',
            
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'movesub'
                    )
                )
            ),            
        
        
        
        
        )
    
    
    
    
    
    ),
    
    
    
);