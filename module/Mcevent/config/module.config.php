<?php
return array (
		
		'navigation' => array (
				'mceventmenue' => array (
						array (
								'label' => 'Kalender',
								'route' => 'mcevent' 
						),
						array (
								'label' => 'Event',
								'route' => 'mcevent_events'
						),						
						 
				) 
		),
		'router' => array (
				'routes' => array (
						'mcevent' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/event',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Index',
												'action' => 'index' 
										) 
								) 
						), 
						'mcevent_events' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/event',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Events',
												'action' => 'index'
										)
								)
						)						
				) 
		),
 		'service_manager' => array (
				'factories' => array (
						'mceventmenue' => 'Mcevent\Service\MceventmenueNavigationFactory', 
				) 
		), 
		'view_manager' => array (
				'template_path_stack' => array (
						'mcevent' => __DIR__ . '/../view' 
				) 
		) 
);