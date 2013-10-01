<?php
return array (
		'navigation' => array (
				'default' => array (
						array (
								'label' => 'Mcwork_Controller_Index',
								'route' => 'mcwork',
								'order' => 1 
						),
						array (
								'label' => 'Mcwork_Controller_Content',
								'route' => 'mcwork_content',
								'order' => 2,
								'resource' => 'authorresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown',
								'pages' => array (
										array (
												'label' => 'Mcwork_Controller_Content_Pages',
												'route' => 'mcwork_pages',
												'resource' => 'publisherresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Content_PageContent',
												'route' => 'mcwork_pagecontent',
												'resource' => 'authorresource' 
										)
										,
										array (
												'label' => 'Mcwork_Controller_Content_Contribution',
												'route' => 'mcwork_contribution',
												'resource' => 'authorresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Content_Navigation',
												'route' => 'mcwork_navigation',
												'resource' => 'publisherresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Content_Menue',
												'route' => 'mcwork_menue',
												'resource' => 'publisherresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Content_Medias',
												'route' => 'mcwork_medias',
												'resource' => 'authorresource' 
										) 
								) 
						),
						array (
								'label' => 'Mcwork_Controller_Conf',
								'route' => 'mcwork_configuration',
								'order' => 3,
								'resource' => 'adminresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown',
								'pages' => array (
										array (
												'label' => 'Mcwork_Controller_Conf_Fieldtypes',
												'route' => 'mcwork_fieldtypes',
												'resource' => 'adminresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Conf_Fieldmetas',
												'route' => 'mcwork_fieldmetas',
												'resource' => 'adminresource' 
										) 
								) 
						),
						array (
								'label' => 'Mcwork_Controller_Admin',
								'route' => 'mcwork_administration',
								'order' => 4,
								'resource' => 'authorresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown',
								'pages' => array (
										array (
												'label' => 'Mcwork_Controller_Admin_Accounts',
												'route' => 'mcwork_accounts',
												'resource' => 'adminresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Admin_Contacts',
												'route' => 'mcwork_contacts',
												'resource' => 'authorresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Admin_Users',
												'route' => 'mcwork_users',
												'resource' => 'managerresource' 
										),
										array (
												'label' => 'Mcwork_Controller_Admin_Logs',
												'route' => 'mcwork_logs',
												'resource' => 'managerresource'
										),
										array (
												'label' => 'Mcwork_Controller_Admin_Cache',
												'route' => 'mcwork_cache',
												'resource' => 'managerresource'
										)																				 
								) 
						),
						array (
								'label' => 'Mcwork_Controller_Apps',
								'route' => 'mcwork_apps',
								'order' => 5,
								'resource' => 'authorresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown' 
						) 
				) 
		),
		
		'router' => array (
				'routes' => array (
						'mcwork' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/dashboard',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Index',
												'action' => 'index' 
										) 
								) 
						),
						
						'mcwork_content' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/content',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content' 
										) 
								) 
						),
						
						'mcwork_pages' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/pages',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Pages' 
										) 
								) 
						),
						'mcwork_pagecontent' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/pagecontent',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\PageContent' 
										) 
								) 
						),
						'mcwork_contribution' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/contributions',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Contribution' 
										) 
								) 
						),
						
						'mcwork_navigation' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/navigation',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Navigation' 
										) 
								) 
						),
						
						'mcwork_menue' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/menuetrees',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Menue' 
										) 
								) 
						),
						
						'mcwork_medias' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/medias',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Medias' 
										) 
								) 
						),
						
						'mcwork_configuration' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/configuration',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf' 
										) 
								) 
						),
						
						'mcwork_fieldtypes' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/fieldtypes',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf\Fieldtypes' 
										) 
								) 
						),
						
						'mcwork_fieldmetas' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/fieldmetas',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf\Fieldmetas' 
										) 
								) 
						),
						
						'mcwork_administration' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/administration',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin' 
										) 
								) 
						),
						
						'mcwork_accounts' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/accounts',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Accounts' 
										) 
								) 
						),
						'mcwork_contacts' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/contacts',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Contacts' 
										) 
								) 
						),
						'mcwork_users' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/users',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Users' 
										) 
								) 
						),
						
						'mcwork_logs' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/logs',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Logs'
										)
								)
						),
						'mcwork_logs_display' => array(
								'type' => 'Segment',
								'options' => array(
										'route' => '/mcwork/logs/display[/][:id]',
					                    'constraints' => array(
					                        'id' => '[a-zA-Z0-9/._-]+'
					                    ),
										'defaults' => array(
												'controller' => 'Mcwork\Controller\Admin\Logs\Display'
										)
								)
						),	

						'mcwork_logs_download' => array(
								'type' => 'Segment',
								'options' => array(
										'route' => '/mcwork/logs/download[/][:id]',
										'constraints' => array(
												'id' => '[a-zA-Z0-9/._-]+'
										),
										'defaults' => array(
												'controller' => 'Mcwork\Controller\Admin\Logs\Download'
										)
								)
						),	

						'mcwork_logs_clear' => array(
								'type' => 'Segment',
								'options' => array(
										'route' => '/mcwork/logs/clear[/][:id]',
										'constraints' => array(
												'id' => '[a-zA-Z0-9/._-]+'
										),
										'defaults' => array(
												'controller' => 'Mcwork\Controller\Admin\Logs\Clear'
										)
								)
						),	
						'mcwork_logs_delete' => array(
								'type' => 'Segment',
								'options' => array(
										'route' => '/mcwork/logs/delete[/][:id]',
										'constraints' => array(
												'id' => '[a-zA-Z0-9/._-]+'
										),
										'defaults' => array(
												'controller' => 'Mcwork\Controller\Admin\Logs\Delete'
										)
								)
						),											

						'mcwork_cache' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/cache',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Cache'
										)
								)
						),						
						
						
						'mcwork_apps' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/apps',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Apps' 
										) 
								) 
						) 
				) 
		),
		
		'service_manager' => array (
				'factories' => array (
						'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
						'Mcwork\Pages' => 'Mcwork\Service\McworkpagesServiceFactory',
				) 
		),
		
		'view_manager' => array (
				'template_map' => array (
						'mcwork/layout/admin' => __DIR__ . '/../view/layout/admin.phtml' 
				),
				'template_path_stack' => array (
						'mcwork' => __DIR__ . '/../view' 
				) 
		),
		'contentinum_config' => array (
				'templates_files' => array(
						'mcworkpages' => CON_ROOT_PATH . '/data/locale/etc/mcwork.pages.xml',
				),				
	
		),
		'assetic_configuration' => array (
				
				'controllers' => array (
						'Mcwork\Controller\Index' => array (
								'@mcworkcore',
								'@head_custom',
								'@mcworkscripts' 
						),
						'Mcwork\Controller\Admin\Logs' => array (
								'@mcworktable',
								'@head_custom',
								'@mcworkscripts' 
						),
				),
				'routes' => array (					
						'mcwork(.*)' => array (
								'@mcworkcore',
								'@head_custom',
								'@mcworkscripts' 
						),
						
				),
				
				'modules' => array (
						'mcwork' => array (
								'root_path' => __DIR__ . '/../assets',
								
								'collections' => array (
										'mcworkcore' => array (
												'assets' => array (
														'backend/css/font-awesome.css',
														'backend/css/foundation.min.css',
														'backend/css/admin.base.css' 
												),
												'filters' => array (
														'?CssRewriteFilter' => array (
																'name' => 'Assetic\Filter\CssRewriteFilter' 
														),
														'?CssMinFilter' => array (
																'name' => 'Assetic\Filter\CssMinFilter' 
														) 
												) 
										),
										'mcworktable' => array (
												'assets' => array (
														'backend/css/font-awesome.css',
														'backend/css/foundation.min.css',
														'backend/css/admin.base.css',														
														'backend/css/admin.table.css'
												),
												'filters' => array (
														'?CssRewriteFilter' => array (
																'name' => 'Assetic\Filter\CssRewriteFilter'
														),
														'?CssMinFilter' => array (
																'name' => 'Assetic\Filter\CssMinFilter'
														)
												)
										),										
										'head_custom' => array (
												'assets' => array (
														'backend/js/vendor/custom.modernizr.js' 
												),
												'filters' => array (
														'?JSMinFilter' => array (
																'name' => 'Assetic\Filter\JSMinFilter' 
														) 
												) 
										)
										,
										'mcworkscripts' => array (
												'assets' => array (
														'backend/js/vendor/jquery-1.10.2.min.js',
														'backend/js/foundation.min.js',
														'backend/js/admin.main.js' 
												),
												'filters' => array (
														'?JSMinFilter' => array (
																'name' => 'Assetic\Filter\JSMinFilter' 
														) 
												) 
										) 
								) 
						) 
				) 
		)
		 
);