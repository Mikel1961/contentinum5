<?php
return array (
		
		'navigation' => array (
				'mceventmenue' => array (
						array (
								'label' => 'Kalender',
								'route' => 'mcevent_calendar',
								'pages' => array (
										array (
												'label' => 'Events',
												'route' => 'mcevent_events' 
										),
										array (
												'label' => 'Organizer',
												'route' => 'mcevent_organizer' 
										),
										array (
												'label' => 'Resources',
												'route' => 'mcevent_resources',
												'pages' => array (
														array (
																'label' => 'Types',
																'route' => 'mcevent_resources_types' 
														) 
												) 
										),
										array (
												'label' => 'Configuration',
												'route' => 'mcevent_configuration',
												'pages' => array (
														array (
																'label' => 'Types',
																'route' => 'mcevent_calendar_types' 
														),
														array (
																'label' => 'Groups',
																'route' => 'mcevent_calendar_groups' 
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
		) 
);