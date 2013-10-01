<?php
return array (
		
		'navigation' => array (
				'default' => array (
						array (
								'label' => 'Mcwork_Controller_User',
								'route' => 'mcuser',
								'id' => 'usr_id',
								'order' => 99,
								'resource' => 'authorresource',
								'listClass' => 'has-dropdown',
								'subUlClass' => 'dropdown',
								'pages' => array (
										array (
												'label' => 'Login',
												'route' => 'mcuser',
												'resource' => 'index',
										),
										array (
												'label' => 'Profil',
												'route' => 'mcuser_profil',
												'resource' => 'memberresource',
										),
										array (
												'label' => 'Avatar',
												'route' => 'mcuser_avatar',
												'resource' => 'memberresource',
										),
										array (
												'label' => 'Logout',
												'route' => 'mcuser_logout',
												'resource' => 'memberresource',
										),
								)
						)						 
				)
				 
		),
		'router' => array (
				'routes' => array (
						'mcuser' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/user',
										'defaults' => array (
												'controller' => 'Mcuser\Controller\Index',
												'action' => 'index' 
										) 
								) 
						),
						'mcuser_profil' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/userprofil',
										'defaults' => array (
												'controller' => 'Mcuser\Controller\Profil',
												'action' => 'index' 
										) 
								) 
						),
						'mcuser_avatar' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/useravatar',
										'defaults' => array (
												'controller' => 'Mcuser\Controller\Avatar',
												'action' => 'index' 
										) 
								) 
						),
						'mcuser_logout' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/logout',
										'defaults' => array (
												'controller' => 'Mcuser\Controller\Logout',
												'action' => 'index' 
										) 
								) 
						) 
				) 
		),
		'view_manager' => array (
				'template_path_stack' => array (
						'mcuser' => __DIR__ . '/../view' 
				) 
		) 
);