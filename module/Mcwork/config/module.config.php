<?php
return array(
    'router' => array(
        'routes' => array(
            'mcwork' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/mcwork',
                    'defaults' => array(
                        'controller' => 'Mcwork\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
        	'mcwork_accounts' => array(
        			'type' => 'Zend\Mvc\Router\Http\Literal',
        			'options' => array(
        					'route' => '/mcwork/accounts',
        					'defaults' => array(
        							'controller' => 'Mcwork\Controller\Accounts',
        							'action' => 'index'
        					)
        			)
        	),        		
       ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'mcwork' => __DIR__ . '/../view'
        )
    ),
);