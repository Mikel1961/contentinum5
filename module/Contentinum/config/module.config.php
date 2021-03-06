<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Contentinum\Controller\Index',
                        'action' => 'index'
                    )
                )
            )
            ,
            'page_app' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/:pages[/:sub]',
                    'constraints' => array(
                        'pages' => '[a-zA-Z0-9._-]+',
                        'sub' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Contentinum\Controller\App',
                        'action' => 'index'
                    )
                )
            )
        )
        
    ),
    'service_manager' => array(
        'factories' => array(
            'appsmenu' => 'Contentinum\Service\AppsmenuNavigationFactory',
            'Contentinum\Configure' => 'Contentinum\Service\ConfigServiceFactory',
            'Contentinum\Logs' => 'Contentinum\Service\LogServiceFactory',
            'Contentinum\Logs\Applog' => 'Contentinum\Service\ApplogServiceFactory',
            'Contentinum\Acl' => 'Contentinum\Service\AclSettingsServiceFactory',
            'Contentinum\Acl\Acl' => 'Contentinum\Service\AclServiceFactory',
            'Contentinum\Acl\DefaultRole' => 'Contentinum\Service\AclDefaultRoleServiceFactory',
            'Contentinum\Cache\Filesystem7200' => function ($sm)
            {
                $cache = Zend\Cache\StorageFactory::factory(array(
                    'adapter' => array(
                        'name' => 'filesystem',
                        'ttl' => 7200,
                        'options' => array(
                            'namespace' => 'mcwork',
                            'cache_dir' => CON_ROOT_PATH . '/data/cache'
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
            'Contentinum\Htmlwidgets' => 'Contentinum\Service\HtmlwidgetsServiceFactory',
            'Contentinum\Htmllayouts' => 'Contentinum\Service\HtmllayoutsServiceFactory',
            'Contentinum\Charset' => 'Contentinum\Service\CharsetServiceFactory',
            'Contentinum\Locale' => 'Contentinum\Service\LocaleServiceFactory',
            'Contentinum\Robots' => 'Contentinum\Service\RobotsServiceFactory',
            'Contentinum\Publish' => 'Contentinum\Service\PublishServiceFactory',
            'Contentinum\Resource' => 'Contentinum\Service\ResourceServiceFactory',
            'Contentinum\Httpstatuscode' => 'Contentinum\Service\HttpstatuscodeServiceFactory',
            'Contentinum\Preference' => 'Contentinum\Service\PreferenceServiceFactory',
            'Contentinum\Webmedias' => 'Contentinum\Service\MediasServiceFactory',
            'Contentinum\Customer' => 'Contentinum\Service\CustomConfigServiceFactory'
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator'
        )
    ),
    'translator' => array(
        'locale' => 'de_DE',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Contentinum\Controller\Index' => 'Contentinum\Controller\IndexController',
            'Contentinum\Controller\App' => 'Contentinum\Controller\ApplicationController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/foundation.phtml',
            'contentinum/index/index' => __DIR__ . '/../view/contentinum/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    
    'doctrine' => array(
        'driver' => array(
            'contentinum_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Contentinum/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Contentinum\Entity' => 'contentinum_driver'
                )
            )
        )
    ),
    
    'contentinum_config' => array(
        'templates_files' => array(
            'htmlwidgets' => __DIR__ . '/../../../data/locale/etc/templates/htmlwidgets.library.xml',
            'htmllayouts' => __DIR__ . '/../../../data/locale/etc/templates/htmllayouts.library.xml',
            'charset' => __DIR__ . '/../../../data/locale/etc/templates/charset.data.xml',
            'locale' => __DIR__ . '/../../../data/locale/etc/templates/locale.data.xml',
            'robots' => __DIR__ . '/../../../data/locale/etc/templates/robots.data.xml',
            'publish' => __DIR__ . '/../../../data/locale/etc/templates/publish.data.xml',
            'resource' => __DIR__ . '/../../../data/locale/etc/templates/resource.data.xml',
            'httpstatuscode' => __DIR__ . '/../../../data/locale/etc/templates/httpstatuscode.data.xml'
        ),
        'etc_cfg_files' => array(
            'customconfig' => __DIR__ . '/../../../data/locale/etc/custom.config.php'
        ),
        'db_cache_keys' => array(
            'preference' => array(
                'cache' => 'websiteconfiguration',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebPreferences',
                'sortby' => 'host'
            ),
            'webmedias' => array(
                'cache' => 'websitemedias',
                'entitymanager' => 'doctrine.entitymanager.orm_default',
                'entity' => 'Contentinum\Entity\WebMedias',
                'sortby' => 'media_source'
            )
        ),
        'log_configure' => array(
            'log_priority' => 6,
            'log_writer' => array(
                'application' => __DIR__ . '/../../../data/logs/application.log',
                'error' => __DIR__ . '/../../../data/logs/errors.application.log'
            ),
            'log_filter' => array(
                'application' => array(
                    'priority' => array(
                        'priority' => Zend\Log\Logger::WARN,
                        'operator' => '>='
                    )
                ),
                'error' => array(
                    'priority' => array(
                        'priority' => Zend\Log\Logger::ERR,
                        'operator' => '<='
                    )
                )
            )
        ),
        'contentinum_acl' => array(
            'acl_default_role' => 'admin',
            'acl_settings' => array(
                'roles' => array(
                    'guest',
                    'member',
                    'intranet',
                    'author',
                    'publisher',
                    'manager',
                    'admin',
                    'root'
                ),
                'parent' => array(
                    'member' => 'guest',
                    'intranet' => 'member',
                    'author' => 'intranet',
                    'publisher' => 'author',
                    'manager' => 'publisher',
                    'admin' => 'manager',
                    'root' => 'admin'
                ),
                
                'resources' => array(
                    'index',
                    'error',
                    'medias',
                    'memberresource',
                    'intranetresource',
                    'authorresource',
                    'publisherresource',
                    'managerresource',
                    'adminresource',
                    'rootresource'
                ),
                
                'rules' => array(
                    'allow' => array(
                        'guest' => array(
                            'index' => 'all',
                            'error' => 'all',
                            'medias' => 'all'
                        ),
                        'member' => array(
                            'memberresource' => 'all'
                        ),
                        'author' => array(
                            'authorresource' => 'all'
                        ),
                        'publisher' => array(
                            'publisherresource' => 'all'
                        ),
                        'manager' => array(
                            'managerresource' => 'all'
                        ),
                        'admin' => array(
                            'adminresource' => 'all'
                        ),
                        'root' => array(
                            'rootresource' => 'all'
                        )
                    )
                )
            )
        )
    ),
    'assetic_configuration' => array(
        'debug' => true,
        'buildOnRequest' => true,
        'combine' => true,
        'webPath' => realpath('public/assets'),
        'basePath' => 'assets',
        'cachePath' => 'data/cache',
        
        'controllers' => array(
            'Contentinum\Controller\Index' => array(
                '@foundation',
                '@head_foundation',
                '@scriptsfoundation'
            ),
            'Contentinum\Controller\App' => array(
                '@foundation',
                '@head_foundation',
                '@scriptsfoundation'
            )
        ),
        
        'modules' => array(
            'contentinum' => array(
                'root_path' => __DIR__ . '/../assets',
                
                'collections' => array(
                    'foundation' => array(
                        'assets' => array(
                            'foundation/css/foundation.css',
                            'foundation/css/foundation.form.css'
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
                    'head_foundation' => array(
                        'assets' => array(
                            'foundation/js/vendor/modernizr.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    )
                    ,
                    'scriptsfoundation' => array(
                        'assets' => array(
                            'foundation/js/vendor/jquery.js',
                            'foundation/js/foundation.min.js',
                            'foundation/js/std.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                    'core' => array(
                        'assets' => array(
                            'default/css/normalize.css',
                            'default/css/main.css'
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
                    'head_modernizr' => array(
                        'assets' => array(
                            'default/js/vendor/modernizr-2.6.2.min.js'
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    )
                    ,
                    'scripts' => array(
                        'assets' => array(
                            'default/js/vendor/jquery-1.10.2.min.js',
                            'default/js/plugins.js'
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