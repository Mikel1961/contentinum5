<?php
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Mcwork_Controller_Index',
                //'route' => 'mcwork',
                'uri' => '/mcwork/dashboard',
                'order' => 1
            ),
            array(
                'label' => 'Content',
                'uri' => '#',//mcwork/content',
                'order' => 2,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown',
                'pages' => array(
                    array(
                        'label' => 'Pages',
                        'uri' => '/mcwork/pages',
                        'resource' => 'publisherresource'
                    ),
                    array(
                        'label' => 'PageContent',
                        'uri' => '/mcwork/pagecontent',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Contribution',
                        'uri' => '/mcwork/contribution',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Navigation',
                        'uri' => '/mcwork/navigation',
                        'resource' => 'publisherresource'
                    ),
                    array(
                        'label' => 'Menue',
                        'uri' => '/mcwork/menue',
                        'resource' => 'publisherresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Content_Medias',
                        'uri' => '/mcwork/medias/file',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Media meta description',
                        'uri' => '/mcwork/medias/metadatas',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Media Blocks',
                        'uri' => '/mcwork/mediablockmetas',
                        'resource' => 'authorresource'
                    )
                )
            ),
            array(
                'label' => 'Mcwork_Controller_Conf',
                'uri' => '#',///mcwork/configuration',
                'order' => 3,
                'resource' => 'adminresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown',
                'pages' => array(
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
                        'label' => 'Mcwork_Controller_Conf_Fieldtypes',
                        'uri' => '/mcwork/fieldtypes',
                        'resource' => 'adminresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Conf_Fieldmetas',
                        'uri' => '/mcwork/fieldmetas',
                        'resource' => 'adminresource'
                    )
                )
            ),
            array(
                'label' => 'Mcwork_Controller_Admin',
                'uri' => '#',//mcwork/administration',
                'order' => 4,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown',
                'pages' => array(
                    array(
                        'label' => 'Mcwork_Controller_Admin_Accounts',
                        'uri' => '/mcwork/accounts',
                        'resource' => 'adminresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Admin_Contacts',
                        'uri' => '/mcwork/contacts',
                        'resource' => 'authorresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Admin_Users',
                        'uri' => '/mcwork/users',
                        'resource' => 'managerresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Admin_Logs',
                        'uri' => '/mcwork/logs',
                        'resource' => 'managerresource'
                    ),
                    array(
                        'label' => 'Mcwork_Controller_Admin_Cache',
                        'uri' => '/mcwork/cache',
                        'resource' => 'managerresource'
                    )
                )
            ),
            array(
                'label' => 'Mcwork_Controller_Apps',
                'uri' => '/mcwork/apps',
                'order' => 5,
                'resource' => 'authorresource',
                'listClass' => 'has-dropdown',
                'subUlClass' => 'dropdown'
            )
        )
    ),
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
                                'mcworkpages' => '[a-zA-Z0-9._-]+'
                            ),
                            'defaults' => array(
                                'controller' => 'Mcwork\Controller\App'
                            // 'action' => 'index'
                                                        )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'mcwork_app_add' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'Mcwork\Controller\AddItems'
                                    )
                                )
                            ),
                            'mcwork_app_edit' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+'
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
                            						'controller' => 'Mcwork\Controller\Content\Mediametadatas',
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
                            						'controller' => 'Mcwork\Controller\Content\Mediametadatas',
                            						'action' => 'savemetas'
                            				)
                            		)
                            ), 
                            'mcwork_app_mediametatags' => array(
                            		'type' => 'Zend\Mvc\Router\Http\Segment',
                            		'options' => array(
                            				'route' => '/mediametatags[/][:id]',
                            				'constraints' => array(
                            						'id' => '[a-zA-Z0-9/_-]+'
                            				),
                            				'defaults' => array(
                            						'controller' => 'Mcwork\Controller\Content\Mediametadatas',
                            						'action' => 'mediametatags'
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
                                    )
                                    ,
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
            'Mcwork\Pages' => 'Mcwork\Service\McworkpagesServiceFactory',
            'Mcwork\PagesUrlSplit' => 'Mcwork\Service\McworkPageUrlServiceFactory',
            'Mcwork\Toolbar' => 'Mcwork\Service\McworkToolbarServiceFactory',
            'Mcwork\Tableedit' => 'Mcwork\Service\McworkTableeditServiceFactory',
            'Mcwork\FormDecco' => 'Mcwork\Service\McworkDeccoFormServiceFactory',
            'Mcwork\FormDecorators' => 'Mcwork\Service\McworkFormdecoratorsServiceFactory',
            'Mcwork\Medias' => 'Mcwork\Service\McworkMediasServiceFactory',
            'Mcwork\Cachekeys' => 'Mcwork\Service\McworkCacheKeysServiceFactory',
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
            'mcworkpages' => __DIR__ . '/../../../data/locale/etc/mcwork.pages.xml'
        ),
        'etc_cfg_files' => array(
            'mcworktoolbar' => __DIR__ . '/../../../data/locale/etc/mcwork.toolbar.php',
            'mcworktableedit' => __DIR__ . '/../../../data/locale/etc/mcwork.tableedit.php',
            'mcworkformdecco' => __DIR__ . '/../../../data/locale/etc/mcwork.formdecorators.php',
            'mcworkcachekeys' => __DIR__ . '/../../../data/locale/etc/mcwork.caches.php'
        ),
        'db_cache_keys' => array(
            'mcworkwebmedias' => array(
                'cache' => 'mcworkwebsitemedias',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebMedias',
                'sortby' => 'media_source'
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
            )
            ,
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
            'Mcwork\Controller\EditItem'  => array(
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
            'Mcwork\Controller\Content\Mediametadatas' => array(
                '@mcworkmediametas',
                '@head_custom',                
                '@mcworkmediametascripts'
            ),
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
                    		        'backend/css/admin.dyngrid.css',
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
                    				'backend/css/admin.base.css',

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
                            'backend/css/vendor/TableTools.css',
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
                            'backend/js/vendor/jquery-1.10.2.min.js',
                            'backend/js/foundation.min.js',
                            'backend/js/vendor/datatable.v1.10.1/jquery.dataTables.min.js',
                            //'backend/js/vendor/datatable/TableTools.min.js',
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
                    				'backend/js/vendor/jquery-1.10.2.min.js',
                    				'backend/js/foundation.min.js',
                    				'backend/js/vendor/chosen/chosen.jquery.js',
                    		        'backend/js/vendor/jquery.datetimepicker.js',
                    				'backend/js/admin.main.js',
                    		        'backend/js/admin.form.js',
                    		     
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
                    				'backend/js/foundation.min.js',
                    		        'backend/js/vendor/jquery.imagesloaded.js',
                    		        'backend/js/vendor/jquery.wookmark.js',
                    		        'backend/js/vendor/mcwork.tagging.js',
                    		        'backend/js/vendor/jquery-ui-autocomplete.js',                    		    
                    				'backend/js/admin.main.js',
                    		        'backend/js/admin.dyngrid.js',
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