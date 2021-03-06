<?php
return array(
    'invokables' => array(
        'Mcwork\Controller\Index' => 'Mcwork\Controller\IndexController',
        'Mcwork\Controller\Content' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Content\Pages' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Content\PageContent' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Content\Contribution' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Content\Navigation' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Content\Menue' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Conf' => 'Mcwork\Controller\McworkappController',
        'Mcwork\Controller\Apps' => 'Mcwork\Controller\McworkappController'
    ),
    'factories' => array(
        'Mcwork\Controller\App' => function ($sl)
        {
            $app = new Contentinum\Service\App\Contentinum();
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $app->setOptions($params->toArray());
            $app->cutUri();
            $customer = $sl->getServiceLocator()->get('Contentinum\Customer');
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    if (false != ($ctrlName = $app->getOptions('controller'))) {
                        $ctrl = new $ctrlName();
                    } else {
                        $ctrl = new Mcwork\Controller\McworkappController();
                    }
                    if (false != ($methodName = $app->getOptions('ctrlmethod'))) {
                        $ctrl->setMethod($methodName);
                    }
                    $workerName = $app->getOptions('worker');
                    $entityName = $app->getOptions('entity');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    }
                    
                    $services = $app->getOptions('services');
                    if (is_array($services) && ! empty($services)) {
                    	foreach ($services as $key => $service) {
                    		$ctrl->addServices($key,$service);
                    	}
                    }                    
                    
                    if (false != ($storage = $app->getOptions('storage'))) {
                        $worker = new $workerName();
                        $worker->setStorage(new $storage());
                    }
                    
                    if (false != ($findBy = $app->getOptions('findBy'))) {
                        $ctrl->setFindBy($findBy);
                    }
                    
                    $ctrl->setEntity(new $entityName());
                    $ctrl->setWorker($worker);
                    $ctrl->setConfiguration($customer);
                    return $ctrl;
                }
            } else {
                return new Mcwork\Controller\McworkappController();
            }
        },
        'Mcwork\Controller\AddItems' => function ($sl)
        {
            $uripath = str_replace('/', '_', $_SERVER['REQUEST_URI']);
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $customer = $sl->getServiceLocator()->get('Contentinum\Customer');
            $page = substr($uripath, 1, strlen($uripath));
            $app = new Contentinum\Service\App\Contentinum();
            $app->setOptions($params->toArray());
            $app->cutUri();
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    $workerName = $app->getOptions('worker');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    } else {
                        $worker = new $workerName($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
                    }
                    $entityName = $app->getOptions('entity');
                    $worker->setEntity(new $entityName());
                    $worker->setSl($sl->getServiceLocator());
                    $targetEntities = $app->getOptions('targetentities');
                    if (is_array($targetEntities) && ! empty($targetEntities)) {
                        foreach ($targetEntities as $key => $tEntity) {
                            $worker->addTargetEntities($key, $tEntity);
                        }
                    }
                    $formName = $app->getOptions('form');
                    $formFactory = new $formName($worker);
                    $decorators = $sl->getServiceLocator()->get('Mcwork\FormDecorators');
                    $decorators = $decorators->default->toArray();
                    if ( false != ( $formAttribs = $app->getOptions('formattributes')  ) ){
                        $decorators['deco-form']['form-attributtes'] = array_merge($decorators['deco-form']['form-attributtes'],$formAttribs);
                    }
                    $formFactory->setDecorators($decorators);
                    $formFactory->setServiceLocator($sl->getServiceLocator());
                    $ctrl = new Mcwork\Controller\AddFormController($formFactory);
                    $ctrl->setWorker($worker);
                    $ctrl->setConfiguration($customer);
                    $ctrl->setFormAction($app->getOptions('formaction'));
                    $ctrl->setToRoute($app->getOptions('settoroute'));
                    if ( false != ( $formButtons = $app->getOptions('formbuttons')  ) ){
                        $ctrl->setFormButtons($formButtons);
                    }                    
                    $populate = $app->getOptions('populate');
                    if (is_array($populate) && ! empty($populate)) {
                        $ctrl->setAddPopulate($populate);
                    }
                    if ( false != ( $populateFromRoute = $app->getOptions('populateFromRoute')  ) ){
                        $ctrl->setPopulateFromRoute($populateFromRoute);
                    }                    
                    return $ctrl;
                }
            }
        },
        'Mcwork\Controller\EditItem' => function ($sl)
        {
            $uripath = str_replace('/', '_', $_SERVER['REQUEST_URI']);
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $customer = $sl->getServiceLocator()->get('Contentinum\Customer');
            $page = substr($uripath, 1, strlen($uripath));
            $app = new Contentinum\Service\App\Contentinum();
            $app->setOptions($params->toArray());
            $app->cutUri();
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    $workerName = $app->getOptions('worker');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    } else {
                        $worker = new $workerName($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
                    }
                    $entityName = $app->getOptions('entity');
                    $worker->setConfiguration($customer);
                    $worker->setEntity(new $entityName());
                    $worker->setSl($sl->getServiceLocator());
                    $targetEntities = $app->getOptions('targetentities');
                    if (is_array($targetEntities) && ! empty($targetEntities)) {
                        foreach ($targetEntities as $key => $tEntity) {
                            $worker->addTargetEntities($key, $tEntity);
                        }
                    }
                    $formName = $app->getOptions('form');
                    $formFactory = new $formName($worker);
                    $decorators = $sl->getServiceLocator()->get('Mcwork\FormDecorators');
                    $decorators = $decorators->default->toArray();
                    if ( false != ( $formAttribs = $app->getOptions('formattributes')  ) ){
                        $decorators['deco-form']['form-attributtes'] = array_merge($decorators['deco-form']['form-attributtes'],$formAttribs);
                    }
                    $formFactory->setDecorators($decorators);
                    $formFactory->setServiceLocator($sl->getServiceLocator());    
                    $ctrl = new Mcwork\Controller\EditFormController($formFactory);
                    if (false != ($unserialize = $app->getOptions('unserialize'))) {
                        $ctrl->setUnserialize($unserialize);
                    }       
                    $ctrl->setWorker($worker);
                    $ctrl->setConfiguration($customer);
                    $ctrl->setFormAction($app->getOptions('formaction'));
                    $ctrl->setToRoute($app->getOptions('settoroute'));
                    if ( false != ( $formButtons = $app->getOptions('formbuttons')  ) ){
                        $ctrl->setFormButtons($formButtons);
                    }                    
                    if (false != ($setexclude = $app->getOptions('setexclude'))) {
                        $ctrl->setExclude($setexclude);
                    }
                    if (false != ($notpopulate = $app->getOptions('notpopulate'))) {
                        $ctrl->setNotPopulate($notpopulate);
                    }                    
                    return $ctrl;
                }
            }
        },
        'Mcwork\Controller\DeleteItem' => function ($sl)
        {
            $uripath = str_replace('/', '_', $_SERVER['REQUEST_URI']);
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $customer = $sl->getServiceLocator()->get('Contentinum\Customer');
            $page = substr($uripath, 1, strlen($uripath));
            $app = new Contentinum\Service\App\Contentinum();
            $app->setOptions($params->toArray());
            $app->cutUri();
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    $workerName = $app->getOptions('worker');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    } elseif (false != ($storage = $app->getOptions('storage'))) {
                        $worker = new $workerName();
                        $worker->setStorage(new $storage());
                    } else {
                        $worker = new $workerName($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
                    }
                    $entityName = $app->getOptions('entity');
                    $entity = new $entityName();
                    $worker->setEntity($entity);
                    if (false != ($ctrlName = $app->getOptions('controller'))) {
                        $ctrl = new $ctrlName();
                    } else {
                        $ctrl = new Mcwork\Controller\McworkappController();
                    }
                    $ctrl->setWorker($worker);
                    $ctrl->setConfiguration($customer);
                    if (false != ($methodName = $app->getOptions('ctrlmethod'))) {
                        $ctrl->setMethod($methodName);
                    }
                    $ctrl->setEntity($entity);
                    return $ctrl;
                }
            }
        },
        'Mcwork\Controller\DisplayItem' => function ($sl)
        {
            $uripath = str_replace('/', '_', $_SERVER['REQUEST_URI']);
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $page = substr($uripath, 1, strlen($uripath));
            $app = new Contentinum\Service\App\Contentinum();
            $app->setOptions($params->toArray());
            $app->cutUri();
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    $workerName = $app->getOptions('worker');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    } elseif (false != ($storage = $app->getOptions('storage'))) {
                        $worker = new $workerName();
                        $worker->setStorage(new $storage());
                    } else {
                        $worker = new $workerName($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
                    }
                    $entityName = $app->getOptions('entity');
                    $entity = new $entityName();
                    $worker->setEntity($entity);
                    if (false != ($ctrlName = $app->getOptions('controller'))) {
                        $ctrl = new $ctrlName();
                    } else {
                        $ctrl = new Mcwork\Controller\McworkappController();
                    }
                    $ctrl->setWorker($worker);
                    if (false != ($methodName = $app->getOptions('ctrlmethod'))) {
                        $ctrl->setMethod($methodName);
                    }
                    $ctrl->setEntity($entity);
                    return $ctrl;
                }
            }
        },
        'Mcwork\Controller\DownloadItem' => function ($sl)
        {
            $uripath = str_replace('/', '_', $_SERVER['REQUEST_URI']);
            $params = $sl->getServiceLocator()->get('Mcwork\Pages');
            $page = substr($uripath, 1, strlen($uripath));
            $app = new Contentinum\Service\App\Contentinum();
            $app->setOptions($params->toArray());
            $app->cutUri();
            if (true === $app->isPageAvailable()) {
                if (true === $app->setAppData()) {
                    $worker = null;
                    $workerName = $app->getOptions('worker');
                    if (false != ($entityManager = $app->getOptions('entitymanager'))) {
                        $worker = new $workerName($sl->getServiceLocator()->get($entityManager));
                    } elseif (false != ($storage = $app->getOptions('storage'))) {
                        $worker = new $workerName();
                        $worker->setStorage(new $storage());
                    } else {
                        $worker = new $workerName($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
                    }
                    $entityName = $app->getOptions('entity');
                    $entity = new $entityName();
                    $worker->setEntity($entity);
                    if (false != ($ctrlName = $app->getOptions('controller'))) {
                        $ctrl = new $ctrlName();
                    } else {
                        $ctrl = new Mcwork\Controller\McworkappController();
                    }
                    $ctrl->setWorker($worker);
                    if (false != ($methodName = $app->getOptions('ctrlmethod'))) {
                        $ctrl->setMethod($methodName);
                    }
                    $ctrl->setEntity($entity);
                    return $ctrl;
                }
            }
        },
        'Mcwork\Controller\Content\Mcwork' => function ($sl)
        {
            $ctrl = new Mcwork\Controller\McworkController();
        	$ctrl->setEntity(new Contentinum\Entity\WebMedias());
        	$worker = new \ContentinumComponents\Mapper\Worker($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
        	$worker->setLogger($sl->getServiceLocator()->get('Contentinum\Logs\Applog'));
        	$ctrl->setConfiguration($sl->getServiceLocator()->get('Contentinum\Customer'));
        	$ctrl->setWorker($worker);
        	return $ctrl;
        },        
        'Mcwork\Controller\Content\Medias' => function ($sl)
        {
            $ctrl = new Mcwork\Controller\MediaController();
            $ctrl->setEntity(new Mcwork\Entity\MediaFiles());
            $worker = new \ContentinumComponents\Storage\StorageDirectory();
            $worker->setLogger($sl->getServiceLocator()->get('Contentinum\Logs\Applog'));
            $worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
            $ctrl->setWorker($worker);
            $ctrl->setEm($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
            $ctrl->setConfiguration($sl->getServiceLocator()->get('Contentinum\Customer'));
            return $ctrl;
        }
    )
);