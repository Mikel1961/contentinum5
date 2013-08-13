<?php
return array (
		'router' => array (
				'routes' => array (
						'home' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/',
										'defaults' => array (
												'controller' => 'Contentinum\Controller\Index',
												'action' => 'index' 
										) 
								) 
						) 
				) 
		),
		'service_manager' => array (
				
				'factories' => array (
						'Contentinum\Configure' => 'Contentinum\Service\ConfigServiceFactory',
						'Contentinum\Logs' => 'Contentinum\Service\LogServiceFactory',
						'Contentinum\Logs\Applog' => 'Contentinum\Service\ApplogServiceFactory',
				),
				'aliases' => array (
						'translator' => 'MvcTranslator' 
				),		
		),
		'translator' => array (
				'locale' => 'de_DE',
				'translation_file_patterns' => array (
						array (
								'type' => 'gettext',
								'base_dir' => __DIR__ . '/../language',
								'pattern' => '%s.mo' 
						) 
				) 
		),
		'controllers' => array (
				'invokables' => array (
						'Contentinum\Controller\Index' => 'Contentinum\Controller\IndexController' 
				) 
		),
		'view_manager' => array (
				'display_not_found_reason' => true,
				'display_exceptions' => true,
				'doctype' => 'HTML5',
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				'template_map' => array (
						'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
						'contentinum/index/index' => __DIR__ . '/../view/contentinum/index/index.phtml',
						'error/404' => __DIR__ . '/../view/error/404.phtml',
						'error/index' => __DIR__ . '/../view/error/index.phtml' 
				),
				'template_path_stack' => array (
						__DIR__ . '/../view' 
				) 
		),
		'contentinum_config' => array (
				'log_configure' => array (
						'log_priority' => 6,
						'log_writer' => array(
						'application' => CON_ROOT_PATH . '/data/logs/application.log',
						'error' =>  CON_ROOT_PATH . '/data/logs/errors.application.log',
						),
						'log_filter' => array(
							'application' => array('priority' => array(  'priority' => Zend\Log\Logger::WARN, 'operator' => '>=')),
							'error' => array('priority' => array( 'priority' => Zend\Log\Logger::ERR, 'operator' => '<='))
						),
				),
				'contentinum_acl' => array (
						'acl_default_role' => 'guest',
						'acl_settings' => array (
								'roles' => array (
										'guest',
										'member',
										'author',
										'publisher',
										'manager',
										'admin',
										'root' 
								),
								'parent' => array (
										'member' => 'guest',
										'author' => 'member',
										'publisher' => 'author',
										'manager' => 'publisher',
										'admin' => 'manager',
										'root' => 'admin' 
								),
								
								'resources' => array (
										'index',
										'error',
										'medias',
										'memberresource',
										'authorresource',
										'publisherresource',
										'managerresource',
										'adminresource',
										'rootresource' 
								),
								
								'rules' => array (
										'allow' => array (
												'guest' => array (
														'index' => 'all',
														'error' => 'all',
														'medias' => 'all' 
												),
												'member' => array (
														'memberresource' => 'all' 
												),
												'author' => array (
														'authorresource' => 'all' 
												),
												'publisher' => array (
														'publisherresource' => 'all' 
												),
												'manager' => array (
														'managerresource' => 'all' 
												),
												'admin' => array (
														'adminresource' => 'all' 
												),
												'root' => array (
														'rootresource' => 'all' 
												) 
										) 
								) 
						) 
				) 
		) 
);