<?php
return array(
    'router' => array(
        'routes' => array(
            'mcuser' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'Mcuser\Controller\Index',
                        'action' => 'index'
                    )
                )
            )       		
       ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'mcuser' => __DIR__ . '/../view'
        )
    ),
);