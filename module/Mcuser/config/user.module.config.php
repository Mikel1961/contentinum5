<?php
return array (
		
		'navigation' => array (
				'mcusermenue' => array (
						array (
								'label' => 'Profil',
								'route' => 'mcuser_profil' 
						),
						array (
								'label' => 'Avatar',
								'route' => 'mcuser_avatar' 
						),
						array (
								'label' => 'Logout',
								'route' => 'mcuser_logout' 
						) 
				)
				 
		),
		'router' => array (
				'routes' => array (
						'mcuser' => array (
								'type' => 'Zend\Mvc\Router\Http\Literal',
								'options' => array (
										'route' => '/login',
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