<?php
return array(
    
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Mcwork_Controller_Index',
                'uri' => '/mcwork/dashboard',
                'order' => 1
            ),
            array(
                
                'label' => 'Content',
                'uri' => '#',
                'order' => 2,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown',
                'pages' => array(
                    
                    array(
                        'label' => 'Pages',
                        'uri' => '/mcwork/pages',
                        'resource' => 'publisherresource',
                        'listClass' => 'has-dropdown',
                        'subUlClass' => 'dropdown',
                        'pages' => array(
                            array(
                                'label' => 'PageContent',
                                'uri' => '/mcwork/pagecontent',
                                'resource' => 'authorresource'
                            ),
                            array(
                                'label' => 'PageAttribute',
                                'uri' => '/mcwork/pageattribute',
                                'resource' => 'authorresource'
                            )                            
                        )
                    ), // end pages
                    
                    array(
                        'label' => 'Contribution',
                        'uri' => '/mcwork/contribution',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Navigation',
                        'uri' => '/mcwork/navigation',
                        'resource' => 'publisherresource',
                    ), // end navigation
                    
                    array(
                        'label' => 'Forms',
                        'uri' => '/mcwork/form',
                        'resource' => 'authorresource'
                    ), 

                    array(
                        'label' => 'Maps',
                        'uri' => '/mcwork/maps',
                        'resource' => 'authorresource'
                    ),                    
                    
                    array(
                        'label' => 'Medias',
                        'uri' => '/mcwork/medias/file',
                        'resource' => 'authorresource',
                        'listClass' => 'has-dropdown',
                        'subUlClass' => 'dropdown',
                        'pages' => array(
                            array(
                                'label' => 'MediaMetas',
                                'uri' => '/mcwork/medias/metadatas',
                                'resource' => 'authorresource'
                            ),
                            array(
                                'label' => 'MediaGroup',
                                'uri' => '/mcwork/mediagroup',
                                'resource' => 'authorresource'
                            )                           
                        ) // end sub medias
                    ), // end medias
                    
                    array(
                        'label' => 'Directories',
                        'uri' => '/mcwork/accounts', // directory
                        'resource' => 'adminresource',
                        'listClass' => 'has-dropdown',
                        'subUlClass' => 'dropdown',
                        'pages' => array(
                            array(
                                'label' => 'Contacts',
                                'uri' => '/mcwork/contacts',
                                'resource' => 'authorresource'
                            )
                        ) // end sub directories
                    ) // end directories
                ) // end sub content
            ) , // end content
            
            array(
                'label' => 'Administration',
                'uri' => '#',
                'order' => 3,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown',
                'pages' => array(
                    
                    array(
                        'label' => 'Users',
                        'uri' => '/mcwork/users',
                        'resource' => 'managerresource'
                    ),
                    array(
                        'label' => 'Logs',
                        'uri' => '/mcwork/logs',
                        'resource' => 'managerresource'
                    ),
                    array(
                        'label' => 'Cache',
                        'uri' => '/mcwork/cache',
                        'resource' => 'managerresource'
                    ),
                    array(
                        'label' => 'Preferences',
                        'uri' => '/mcwork/preferences',
                        'resource' => 'adminresource'
                    ),
                    array(
                        'label' => 'Redirects',
                        'uri' => '/mcwork/redirects',
                        'resource' => 'adminresource'
                    ),
                    
                    array(
                        'label' => 'Fieldtypes',
                        'uri' => '/mcwork/fieldtypes',
                        'resource' => 'adminresource',
                        'listClass' => 'has-dropdown',
                        'subUlClass' => 'dropdown',
                        'pages' => array(
                            array(
                                'label' => 'Fieldconf',
                                'uri' => '/mcwork/fieldmetas',
                                'resource' => 'adminresource'
                            )
                        ) // end sub fieldtypes
                    ) // end fieldtypes
                )// end sub administration
            ), // end administration
            
            array(
                'label' => 'Mcwork_Controller_Apps',
                'uri' => '/mcwork/apps',
                'order' => 4,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown'
            ) // end apps
        ) // end subkey default
    ), // end mainkey navigation
    
    'router' => array(
        'routes' => array(
            'mcwork_medias' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/mcwork/medias[/][:cd]',
                    'constraints' => array(
                        'cd' => '[a-zA-Z0-9/_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Mcwork\Controller\Content\Medias',
                        'action' => 'index'
                    )
                )
            ),
            'mcwork' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/mcwork',
                    'defaults' => array(
                        'controller' => 'Mcwork\Controller\Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'mcwork_app' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route' => '/:mcworkpages',
                            'constraints' => array(
                                'mcworkpages' => '[a-zA-Z0-9._-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Mcwork\Controller\App'
                            )
                        )
                        // 'action' => 'index'
                        
                        ,
                        'may_terminate' => true,
                        'child_routes' => array(
                            'mcwork_app_category' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/category[/][:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\App'
                                    )
                                )
                            ),                            
                            'mcwork_app_add' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/add[/][:cat]',
                                    'constraints' => array(
                                        'cat' => '[0-9]+'
                                    ),                                    
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\AddItems'
                                    )
                                )
                            ),
                            'mcwork_app_edit' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id][/][:cat]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                        'cat' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\EditItem'
                                    )
                                )
                            ),
                            'mcwork_app_delete' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/delete[/][:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\DeleteItem'
                                    )
                                )
                            ),
                            'mcwork_app_clear' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/clear[/][:id]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9._-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\DeleteItem'
                                    )
                                )
                            ),
                            'mcwork_app_display' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/display[/][:id]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9._-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\DisplayItem'
                                    )
                                )
                            ),
                            'mcwork_app_download' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/download[/][:id]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9._-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\DownloadItem'
                                    )
                                )
                            ),
                            'mcwork_app_medias' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/file[/][:cd]',
                                    'constraints' => array(
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'index'
                                    )
                                )
                            ),
                            'mcwork_app_mediametas' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/metadatas[/][:id]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Mcwork',
                                        'action' => 'index'
                                    )
                                )
                            ),
                            'mcwork_app_savemetas' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/savemetas[/][:id]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Mcwork',
                                        'action' => 'savemetas'
                                    )
                                )
                            ),
                            'mcwork_app_mediametaapplication' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/application[/][:mediaapp][/][:id]',
                                    'constraints' => array(
                                        'mediaapp' => '[a-zA-Z0-9._-]+',
                                        'id' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Mcwork',
                                        'action' => 'application'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_configuration' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/configuration',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'configuration'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_properties' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/properties',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'properties'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_upload' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/upload[/][:cd]',
                                    'constraints' => array(
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'upload'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/list[/][:cd]',
                                    'constraints' => array(
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'list'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_newdir' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/makedir[/][:cd]',
                                    'constraints' => array(
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'newfolder'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_remove' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/remove[/][:cd]',
                                    'constraints' => array(
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'remove'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_rename' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/rename',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'rename'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_tree' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/tree',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'tree'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_copy' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/copy',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'copy'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_move' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/move',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'move'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_download' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/download/[:fm][/][:cd]',
                                    'constraints' => array(
                                        'fm' => '[a-zA-Z0-9/._-]+',
                                        'cd' => '[a-zA-Z0-9/_-]+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'download'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_zip' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/zip',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'zip'
                                    )
                                )
                            ),
                            
                            'mcwork_app_medias_unzip' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/unzip',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\Content\Medias',
                                        'action' => 'unzip'
                                    )
                                )
                            )
                        )
                    )
                )
            )
            
        )
        
    )
    ,
    
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            
            'Mcwork\Cache\Data' => function ($sm)
            {
                $cache = Zend\Cache\StorageFactory::factory(array(
                    'adapter' => array(
                        'name' => 'filesystem',
                        'ttl' => 28800,
                        'options' => array(
                            'namespace' => 'mcworkdata',
                            'cache_dir' => CON_ROOT_PATH . '/data/cache/mcwork'
                        )
                    ),
                    'plugins' => array(
                        // Don't throw exceptions on cache errors
                        'exception_handler' => array(
                            'throw_exceptions' => true
                        ),
                        'serializer'
                    )
                ));
                return $cache;
            },  

            'Mcwork\Cache\Structures' => function ($sm)
            {
                $cache = Zend\Cache\StorageFactory::factory(array(
                    'adapter' => array(
                        'name' => 'filesystem',
                        'ttl' => 3600,
                        'options' => array(
                            'namespace' => 'mcworkstructur',
                            'cache_dir' => CON_ROOT_PATH . '/data/cache/mcwork'
                        )
                    ),
                    'plugins' => array(
                        // Don't throw exceptions on cache errors
                        'exception_handler' => array(
                            'throw_exceptions' => true
                        ),
                        'serializer'
                    )
                ));
                return $cache;
            },            
            
            'Mcwork\Pages' => 'Mcwork\Service\Pages\StructureServiceFactory',
            'Mcwork\PublicPages' => 'Mcwork\Service\Pages\PublicServiceFactory',
            'Mcwork\ContributionPages' => 'Mcwork\Service\Pages\ContributionServiceFactory',
            'Mcwork\DefaultPages' => 'Mcwork\Service\Pages\DefaultServiceFactory',
            'Mcwork\Buttons' => 'Mcwork\Service\Elements\ButtonsServiceFactory',
            'Mcwork\Tableedit' => 'Mcwork\Service\Elements\TableeditServiceFactory',
            'Mcwork\Toolbar' => 'Mcwork\Service\Elements\ToolbarServiceFactory',
            
            'Mcwork\Template\Contribution' => 'Mcwork\Service\Template\ContributionServiceFactory',    
            'Mcwork\Template\PageContent' => 'Mcwork\Service\Template\PagecontentServiceFactory',
            
            'Mcwork\Contribution' => 'Mcwork\Service\Content\ContributionServiceFactory',
            'Mcwork\PagesUrlSplit' => 'Mcwork\Service\Pages\UrlServiceFactory',
            
            'Mcwork\FormDecco' => 'Mcwork\Service\Form\DeccoServiceFactory',
            'Mcwork\FormDecorators' => 'Mcwork\Service\Form\DecoratorsServiceFactory',
            'Mcwork\FormRules' => 'Mcwork\Service\Form\RulesServiceFactory',
            
            
            'Mcwork\Medias' => 'Mcwork\Service\Medias\TableServiceFactory',
            'Mcwork\MediaInUse' => 'Mcwork\Service\Medias\InUseServiceFactory',
            'Mcwork\Cachekeys' => 'Mcwork\Service\Cache\RegisterServiceFactory',
            'Mcwork\Plugins' => 'Mcwork\Service\Content\PluginsServiceFactory',
        )
    ),
    
    'view_manager' => array(
        'template_map' => array(
            'mcwork/layout/admin' => __DIR__ . '/../view/layout/admin.phtml'
        ),
        'template_path_stack' => array(
            'mcwork' => __DIR__ . '/../view'
        )
    ),
    'contentinum_config' => array(
        'templates_files' => array(
            'mcwork_pages' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/pages.xml',
            'mcwork_template_contributions' => __DIR__ . '/../../../data/locale/etc/content/contribution.data.xml',
            'mcwork_template_pagecontent' => __DIR__ . '/../../../data/locale/etc/content/pagecontent.data.xml'
        ),
        'etc_cfg_files' => array(
            'mcwork_toolbar' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/toolbar/buttons.php',
            'mcwork_buttons' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/buttons.php',
            'mcwork_tableedit' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/tableedit.php',
            'mcwork_form_decorators' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/form/decorators.php',
            'mcwork_form_rules' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/form/rules.php',
            'mcwork_cache_register' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/cache/register.php',
            'mcwork_plugins' => __DIR__ . '/../../../data/locale/etc/_module/mcwork/plugins.php',
        ),
        'db_cache_keys' => array(
            'mcwork_medias' => array(
                'cache' => 'mcwork_medias',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebMedias',
                'sortby' => 'media_source',
                'savecache' => true,
            ),
            'mcwork_inuse_medias' => array(
                'cache' => 'mcwork_inuse_medias',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                
            ),            
            'mcwork_public_pages' => array(
                'cache' => 'mcwork_public_pages',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebPagesParameter',
                'findBy' => array('onlylink' => '0'),
                'savecache' => true,
            ),
            'mcwork_contribution_pages' => array(
                'cache' => 'mcwork_contribution_pages',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebPagesParameter',
                'savecache' => true,
            ),            
            'mcwork_default_pages' => array(
                'cache' => 'mcwork_default_pages',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebPagesParameter',
                'findBy' => array('onlylink' => '9' ),
                'orderBy' => array('man.label ASC'),
                'savecache' => true,
            ),            
            'mcwork_public_contributions' => array(
                'cache' => 'mcwork_public_contributions',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebContent',  
                'savecache' => true,            
            )
        ),				
				
				
				/*
				'log_configure' => array (
						'log_priority' => 6,
						'log_writer' => array (
								'backend-application' => __DIR__ . '/../../../data/logs/backend.app.log',
								'backend-error' => __DIR__ . '/../../../data/logs/backend.errors.app.log' //
						),
						'log_filter' => array (
								'backend-application' => array (
										'priority' => array (
												'priority' => Zend\Log\Logger::WARN,
												'operator' => '>=' 
										)
								),
								'backend-error' => array (
										'priority' => array (
												'priority' => Zend\Log\Logger::ERR,
												'operator' => '<=' 
										)									
								) 
						) 
				),*/
		        'mcwork_form' => array(
            'deco-form' => array(
                'form-attributtes' => array(
                    'id' => 'myForm',
                    'data-abide' => 'data-abide'
                )
            ),
            'deco-row' => array(
                'tags' => array(
                    '1' => array(
                        'tag' => 'div',
                        'attributes' => array(
                            'class' => 'row'
                        )
                    ),
                    '2' => array(
                        'tag' => 'div',
                        'attributes' => array(
                            'class' => 'large-12 columns'
                        )
                    )
                )
            ),
            'deco-desc' => array(
                'tag' => 'span',
                'attributes' => array(
                    'class' => 'desc'
                )
            ),
            'deco-error' => array(
                'tag' => 'small',
                'separator' => '<br />',
                'attributes' => array(
                    'class' => 'error',
                    'role' => 'alert'
                )
            ),
            'deco-abort-btn' => array(
                'label' => 'Cancel',
                'attributes' => array(
                    'class' => 'button secondary',
                    'id' => 'btnFormCancel'
                )
            )
        )
    ),
    'assetic_configuration' => array(

        'controllers' => array(
            'Mcwork\Controller\AddItems' => array(
                '@mcworkform',
                '@head_custom',
                '@mcworkformscripts'
            ),
            'Mcwork\Controller\EditItem' => array(
                '@mcworkform',
                '@head_custom',
                '@mcworkformscripts'
            ),
            'Mcwork\Controller\Index' => array(
                '@mcworkcore',
                '@head_custom',
                '@mcworkscripts'
            ),
            'Mcwork\Controller\App' => array(
                '@mcworkdyntable',
                '@head_custom',
                '@mcworktblscripts'
            ),
            'Mcwork\Controller\Content\Medias' => array(
                '@mcworkmedias',
                '@head_custom',
                '@mcfilescripts'
            ),
            'Mcwork\Controller\Content\Mcwork' => array(
                '@mcworkmediametas',
                '@head_custom',
                '@mcworkmediametascripts'
            )
        ),
        'routes' => array(
            'mcwork(.*)' => array(
                '@mcworkcore',
                '@head_custom',
                '@mcworkscripts'
            )
        ),
        
        'modules' => array(
            'mcwork' => array(
                'root_path' => __DIR__ . '/../assets',
                
                'collections' => array(
                    'mcworkcore' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/foundation.css',
                            'backend/css/admin.base.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    'mcworkmedias' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/foundation.css',
                            'backend/css/admin.base.css',
                            'backend/css/admin.table.css',
                            'backend/css/vendor/dropzone.3.10.2.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    
                    'mcworkmediametas' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/foundation.css',
                            'backend/css/vendor/mcwork.tagging.css',
                            'backend/css/vendor/jquery-ui-autocomplete.css',
                            'backend/css/admin.base.css',
                            'backend/css/admin.dyngrid.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    
                    'mcworkform' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/foundation.css',
                            'backend/css/vendor/chosen.froms.css',
                            'backend/css/vendor/jquery.datetimepicker.css',
                            'backend/css/admin.base.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    'mcworktable' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/foundation.css',
                            'backend/css/admin.base.css',
                            'backend/css/admin.table.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    'mcworkdyntable' => array(
                        'assets' => array(
                            'backend/css/font-awesome.css',
                            'backend/css/admin.chosen.css',
                            'backend/css/foundation.css',
                            'backend/css/admin.base.css',
                            'backend/css/admin.table.css'
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )
                        )
                    ),
                    'head_custom' => array(
                        'assets' => array(
                            'backend/js/vendor/modernizr.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    'mcfilescripts' => array(
                        'assets' => array(
                            'backend/js/vendor/jquery-1.10.2.min.js',
                            'backend/js/mcwork.language.js',
                            'backend/js/foundation.min.js',
                            'backend/js/vendor/upload/dropzone.3.10.2.js',
                            'backend/js/admin.main.js',
                            'backend/js/admin.files.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    
                    'mcworktblscripts' => array(
                        'assets' => array(
                            'backend/js/vendor/jquery-1.11.1.min.js',
                            'backend/js/mcwork.language.js',
                            'backend/js/foundation.min.js',
                            'backend/js/vendor/datatable.v1.10.2/jquery.dataTables.min.js',                      
                            'backend/js/vendor/chosen/chosen.jquery.min.js',
                            'backend/js/admin.main.js',
                            'backend/js/admin.table.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    'mcworkformscripts' => array(
                        'assets' => array(
                            'backend/js/vendor/jquery-1.11.1.min.js',
                            'backend/js/mcwork.language.js',
                            'backend/js/vendor/upload/jquery.file-ajax.js',
                            'backend/js/foundation.min.js',
                            'backend/js/vendor/chosen/chosen.jquery.js',
                            'backend/js/vendor/jquery.datetimepicker.js',
                            'backend/js/admin.main.js',
                            'backend/js/admin.form.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    'mcworkmediametascripts' => array(
                        'assets' => array(
                            'backend/js/vendor/jquery.js',
                            'backend/js/mcwork.language.js',
                            'backend/js/foundation.min.js',
                            'backend/js/vendor/jquery.imagesloaded.js',
                            'backend/js/vendor/jquery.wookmark.js',
                            'backend/js/vendor/mcwork.tagging.js',
                            'backend/js/vendor/jquery-ui-autocomplete.js',
                            'backend/js/admin.main.js',
                            'backend/js/admin.dyngrid.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    'mcworkscripts' => array(
                        'assets' => array(
                            'backend/js/vendor/jquery-1.10.2.min.js',
                            'backend/js/mcwork.language.js',
                            'backend/js/foundation.min.js',
                            'backend/js/admin.main.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    )
                )
            )
        )
    )
);