<?php
return array (
		'navigation' => array (
				'default' => array (
						array (
								'label' => 'Dashboard',
								'route' => 'mcwork',),						
						array (
								'label' => 'Content',
								'route' => 'mcwork_content',
								'pages' => array (
										array (
												'label' => 'Pages',
												'route' => 'mcwork_pages' 
										),
										array (
												'label' => 'PageContent',
												'route' => 'mcwork_pagecontent' 
										),
										array (
												'label' => 'Contributions',
												'route' => 'mcwork_contribution' 
										),
										array (
												'label' => 'Navigation',
												'route' => 'mcwork_navigation' 
										),
										array (
												'label' => 'Menues',
												'route' => 'mcwork_menue' 
										),
										array(
	                                            'label' => 'Medias',
												'route' => 'mcwork_medias'
                                        )									 
								) 
						)
						,
						array (
								'label' => 'Configuration',
								'route' => 'mcwork_configuration',
								'pages' => array (
										array (
												'label' => 'Fieldtypes',
												'route' => 'mcwork_fieldtypes' 
										),
										array (
												'label' => 'Fieldmetas',
												'route' => 'mcwork_fieldmetas' 
										) 
								) 
						),
						array (
								'label' => 'Administration',
								'route' => 'mcwork_administration',
								'pages' => array (
										array (
												'label' => 'Acconts',
												'route' => 'mcwork_accounts' 
										),
										array (
												'label' => 'Contacts',
												'route' => 'mcwork_contacts' 
										),
										array (
												'label' => 'Users',
												'route' => 'mcwork_users' 
										) 
								) 
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
												'controller' => 'Mcwork\Controller\Content',
										)
								)
						),						
						
						'mcwork_pages' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/pages',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Pages',
										) 
								) 
						),
						'mcwork_pagecontent' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/pagecontent',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\PageContent',
										) 
								) 
						),
						'mcwork_contribution' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/contributions',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Contribution',
										) 
								) 
						),
						
						'mcwork_navigation' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/navigation',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Navigation', 
										) 
								) 
						),
						
						'mcwork_menue' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/menuetrees',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Menue', 
										) 
								) 
						),
						
						'mcwork_medias' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/medias',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Content\Medias',
										)
								)
						),						
						
						'mcwork_configuration' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/configuration',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf', 
										) 
								) 
						),
						
						'mcwork_fieldtypes' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/fieldtypes',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf\Fieldtypes',
										) 
								) 
						),
						
						'mcwork_fieldmetas' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/fieldmetas',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Conf\Fieldmetas',
										) 
								) 
						),
						
						'mcwork_administration' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/administration',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin',
										) 
								) 
						),
						
						'mcwork_accounts' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/accounts',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Accounts',
										) 
								) 
						),
						'mcwork_contacts' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/contacts',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Contacts',
										) 
								) 
						),
						'mcwork_users' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/mcwork/users',
										'defaults' => array (
												'controller' => 'Mcwork\Controller\Admin\Users',
										) 
								) 
						) 
				) 
		),
		
		'service_manager' => array (
				'factories' => array (
						'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory' 
				) 
		),
		
		'view_manager' => array (
				'template_map' => array (
						'mcwork/layout/admin' => __DIR__ . '/../view/layout/admin.phtml' 
				),
				'template_path_stack' => array (
						'mcwork' => __DIR__ . '/../view' 
				) 
		) 
);