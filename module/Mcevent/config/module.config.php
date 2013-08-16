<?php
return array(
    'router' => array(
        'routes' => array(
            'mcevent' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/mcwork/event',
                    'defaults' => array(
                        'controller' => 'Mcevent\Controller\Index',
                        'action' => 'index'
                    )
                )
            )       		
       ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'mcevent' => __DIR__ . '/../view'
        )
    ),
);