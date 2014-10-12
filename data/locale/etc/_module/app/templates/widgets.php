<?php
return array(
    'foundation' => array(
        
        'medialeft' => array(
            'image' => array(
                'element' => 'figure',
                'attr' => array(
                    'class' => 'image-size left'
                ),
                'caption' => 'figcaption'
            )
        ),
        
        
        
         
        'mediaright' => array(
            'image' => array(
                'element' => 'figure',
                'attr' => array(
                    'class' => 'image-size right'
                ),
                'caption' => 'figcaption'
            )
        
        
        ),
        
        'mediacenter' => array(
             
            'image' => array(
                'element' => 'figure',
                'attr' => array(
                    'class' => 'center'
                ),
                'caption' => 'figcaption'
            )
             
        
        ),        
        
        'contentmedialeft' => array(
            'media' => array(                
                'image' => array(
                    'element' => 'figure',
                    'attr' => array(
                        'class' => 'image-size left'
                    ),
                    'caption' => 'figcaption'
                )
            )
            
        ),
        
        'contentmediaright' => array(
            'media' => array(               
                'image' => array(
                    'element' => 'figure',
                    'attr' => array(
                        'class' => 'image-size right'
                    ),
                    'caption' => 'figcaption'
                )
            )
            
        ),
        
        'contentmediacenter' => array(
            'media' => array(          
                'image' => array(
                    'element' => 'figure',
                    'attr' => array(
                        'class' => 'center'
                    ),
                    'caption' => 'figcaption'
                )
            )
            
        ),
        
        'contentblockmedialeft' => array(
            'row' => array('element' => 'div', 'attr' => array('class' => 'block')),
            'grid' => array('element' => 'article', 'attr' => array('class' => 'contribution')),
            'media' => array(
                'image' => array(
                    'element' => 'figure',
                    'attr' => array(
                        'class' => 'media-left'
                    ),
                    'caption' => 'figcaption'
                )
            )
        
        ),        
        
        'contentblockmediaright' => array(
            'row' => array('element' => 'div', 'attr' => array('class' => 'block')),
            'grid' => array('element' => 'article', 'attr' => array('class' => 'contribution')),
            'media' => array(
                'image' => array(
                    'element' => 'figure',
                    'attr' => array(
                        'class' => 'media-right'
                    ),
                    'caption' => 'figcaption'
                )
            )        
        
        ),
        'topbar' => array(
            'row' => array('element' => 'nav', 'attr' => array('class' => 'top-bar', 'data-topbar' => 'data-topbar', 'role' => 'navigation') ),
            'grid' => array('element' => 'section', 'attr' => array('class' => 'top-bar-section')),
            'list' => array('element' => 'ul', 'attr' => array('class' => 'title-area')),
            'listelements' => array( 
                '0' => array('element' => 'li', 'attr' => array('class' => 'name')),
                '1' => array('element' => 'li', 'attr' => array('class' => 'toggle-topbar menu-icon')),
            
            )
        ),
        'navigation' => array(
            'row' => array('element' => 'nav', 'attr' => array('class' => 'navigation', 'role' => 'navigation') ),
        ),
        'content' => array(
            'row' => array('element' => 'section', 'attr' => array('id' => 'maincontent', 'class' => 'row', 'role' => 'main')),
            'grid' => array('element' => 'div', 'attr' => array('class' => 'large-12 columns')),
        ),        
        'contentgrid' => array(
            'row' => array('element' => 'section', 'attr' => array('id' => 'maincontent', 'class' => 'row', 'role' => 'main')),
            'grid' => array('element' => 'div', 'attr' => array('class' => 'large-12 columns')),
        ),        
        'headergrid' => array(
            'row' => array('element' => 'header', 'attr' => array('id' => 'header', 'class' => 'row', 'role' => 'banner')),
            'grid' => array('element' => 'div', 'attr' => array('class' => 'large-12 columns')),
        ),
        'footergrid' => array(
            'row' => array('element' => 'footer', 'attr' => array('id' => 'footer', 'class' => 'row', 'role' => 'contentinfo')),
            'grid' => array('element' => 'div', 'attr' => array('class' => 'large-12 columns')),
        ),
        '_default' => array(
            'row' => array('element' => 'footer', 'attr' => array('class' => 'row')),
            'grid' => array('element' => 'div', 'attr' => array('class' => 'large-12 columns')),
        ),        
    )
);