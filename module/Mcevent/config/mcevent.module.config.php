<?php
return array (
		
		'navigation' => array (
				'appsmenu' => array (
						
						array (
								'label' => 'Kalender',
								'route' => 'mcevent_calendar',
								'resource' => 'memberresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown',
								'pages' => array (
										array (
												'label' => 'Events',
												'route' => 'mcevent_events',
												'resource' => 'publisherresource' 
										),
										array (
												'label' => 'Organizer',
												'route' => 'mcevent_organizer',
												'resource' => 'publisherresource' 
										),
										array (
												'label' => 'Resources',
												'route' => 'mcevent_resources',
												'resource' => 'publisherresource',
												'listClass' => 'has-dropdown',
												'subUlClass' => 'dropdown',
												'pages' => array (
														array (
																'label' => 'Types',
																'route' => 'mcevent_resources_types',
																'resource' => 'managerresource' 
														) 
												) 
										),
										array (
												'label' => 'Configuration',
												'route' => 'mcevent_configuration',
												'resource' => 'managerresource',
												'listClass' => 'has-dropdown',
												'subUlClass' => 'dropdown',
												'pages' => array (
														array (
																'label' => 'Types',
																'route' => 'mcevent_calendar_types',
																'resource' => 'managerresource' 
														),
														array (
																'label' => 'Groups',
																'route' => 'mcevent_calendar_groups',
																'resource' => 'managerresource' 
														) 
												) 
										) 
								) 
						)
						 
				)
				 
		),
		'router' => array (
				'routes' => array (
						'mcevent_calendar' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/calendar',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Index',
												'action' => 'index' 
										) 
								) 
						),
						'mcevent_calendar_types' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/calendar/types',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Calender\Types' 
										) 
								) 
						),
						'mcevent_calendar_groups' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/calendar/groups',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Calender\Groups' 
										) 
								) 
						),
						'mcevent_events' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/events',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Event' 
										) 
								) 
						),
						'mcevent_organizer' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/event/organizer',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Event\Organizer' 
										) 
								) 
						),
						'mcevent_resources' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/event/resources',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Event\Resources' 
										) 
								) 
						),
						'mcevent_resources_types' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/event/resources/types',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Resources\Types' 
										) 
								) 
						),
						'mcevent_configuration' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/calendar/configuration',
										'defaults' => array (
												'controller' => 'Mcevent\Controller\Event\Configuration' 
										) 
								) 
						) 
				) 
		),
		'view_manager' => array (
				'template_path_stack' => array (
						'mcevent' => __DIR__ . '/../view' 
				) 
		),
		'assetic_configuration' => array (
				'default' => array (
						'assets' => array (
								'@mcworkcore',
								'@head_custom',
								'@mcworkscripts' 
						) 
				),
				'controllers' => array (
						'Mcevent\Controller\Index' => array (
								'@mcworkcore',
								'@head_custom',
								'@mcworkscripts' 
						) 
				) 
		) 
);