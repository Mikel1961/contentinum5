<?php
return array (
		'invokables' => array (
				'Mcwork\Controller\Index' => 'Mcwork\Controller\IndexController',
				'Mcwork\Controller\Content' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Content\Pages' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Content\PageContent' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Content\Contribution' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Content\Navigation' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Content\Menue' => 'Mcwork\Controller\McworkappController',	
				//'Mcwork\Controller\Content\Medias' => 'Mcwork\Controller\MediaController',
				'Mcwork\Controller\Conf' => 'Mcwork\Controller\McworkappController',
				//'Mcwork\Controller\Conf\Fieldtypes' => 'Mcwork\Controller\McworkappController',
				//'Mcwork\Controller\Conf\Fieldmetas' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin' => 'Mcwork\Controller\McworkappController',
				//'Mcwork\Controller\Admin\Accounts' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin\Contacts' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin\Users' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Apps' => 'Mcwork\Controller\McworkappController',
		),
		'factories' => array(
		        'Mcwork\Controller\Content\Medias' => function ($sl){
		            $ctrl = new Mcwork\Controller\MediaController();
		            $ctrl->setEntity(new Mcwork\Entity\MediaFiles());
		            $worker = new \ContentinumComponents\Storage\StorageDirectory();
		            $worker->setLogger($sl->getServiceLocator()->get('Contentinum\Logs\Applog'));
		            $worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		            $ctrl->setWorker($worker);
		            return $ctrl;
		         },
		         'Mcwork\Controller\Admin\Accounts' => function ($sl){
		             $ctrl = new Mcwork\Controller\McworkappController();
		             $ctrl->setEntity(new Contentinum\Entity\Accounts() );
		             $ctrl->setWorker(new \ContentinumComponents\Mapper\Worker($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default')));
		             return $ctrl;
		         },
		         'Mcwork\Controller\Conf\Fieldtypes' => function ($sl){
		         	$ctrl = new Mcwork\Controller\McworkappController();
		         	$ctrl->setEntity(new Contentinum\Entity\FieldTypes() );
		         	$ctrl->setWorker(new \ContentinumComponents\Mapper\Worker($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default')));
		         	return $ctrl;
		         },	
		         'Mcwork\Controller\Conf\AddFieldTypes' => function ($sl){
		         	$em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		         	$worker = new ContentinumComponents\Mapper\Process($em);
		         	$worker->setEntity(new Contentinum\Entity\FieldTypes() );
		         	$formFactory = new Mcwork\Form\FieldtypesFrom($worker);
		         	$formFactory->setDecorators($sl->getServiceLocator()->get('Mcwork\FormDecco'));
		         	$ctrl = new Mcwork\Controller\AddFormController($formFactory);
		         	$ctrl->setWorker($worker);
		         	$ctrl->setFormAction('/mcwork/fieldtypes/add');
		         	$ctrl->setToRoute('mcwork_fieldtypes');
		         	return $ctrl;
		         },		
		         'Mcwork\Controller\Conf\EditFieldTypes' => function ($sl){
		             $em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		             $worker = new ContentinumComponents\Mapper\Process($em);
		             $worker->setEntity(new Contentinum\Entity\FieldTypes());
		             $formFactory = new Mcwork\Form\FieldtypesFrom($worker);
		             $formFactory->setDecorators($sl->getServiceLocator()->get('Mcwork\FormDecco'));		             
		             $ctrl = new Mcwork\Controller\EditFormController($formFactory);
		             $ctrl->setWorker($worker);
		             $ctrl->setFormAction('/mcwork/fieldtypes/edit');
		             $ctrl->setToRoute('mcwork_fieldtypes');
		             $ctrl->setExclude(array('field' => 'id'));
		             return $ctrl;		             
		         },
		         'Mcwork\Controller\Conf\DeleteFieldTypes' => function($sl){
		         	$em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		         	$worker = new Mcwork\Model\DeleteItem($em);
		         	$entity = new Contentinum\Entity\FieldTypes();
		         	$worker->setEntity($entity);
		         	$ctrl = new Mcwork\Controller\McworkappController();
		         	$ctrl->setWorker($worker);
		         	$ctrl->setMethod('deleteRow');
		         	$ctrl->setEntity($entity );
		         	return $ctrl;
		         	 
		         },		         
		         'Mcwork\Controller\Conf\Fieldmetas' => function ($sl){
		         	$ctrl = new Mcwork\Controller\McworkappController();
		         	$ctrl->setEntity(new Contentinum\Entity\FieldTypeMetas() );
		         	$ctrl->setWorker(new \ContentinumComponents\Mapper\Worker($sl->getServiceLocator()->get('doctrine.entitymanager.orm_default')));
		         	return $ctrl;
		         },		
		         'Mcwork\Controller\Conf\AddFieldMetas' => function ($sl){
		             $em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		             $worker = new ContentinumComponents\Mapper\Process($em);
		             $worker->setEntity(new Contentinum\Entity\FieldTypeMetas());
		             $worker->addTargetEntities('fieldTypes', 'Contentinum\Entity\FieldTypes') ;
		             $formFactory = new Mcwork\Form\FieldmetasForm($worker);
		             $formFactory->setDecorators($sl->getServiceLocator()->get('Mcwork\FormDecco'));
		             $ctrl = new Mcwork\Controller\AddFormController($formFactory);
		             $ctrl->setWorker($worker);
		             $ctrl->setFormAction('/mcwork/fieldmetas/add');
		             $ctrl->setToRoute('mcwork_fieldmetas');
		             return $ctrl; 		             
		         },
		         'Mcwork\Controller\Conf\EditFieldMetas' => function ($sl){
		             $em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		             $worker = new ContentinumComponents\Mapper\Process($em);
		             $worker->setEntity(new Contentinum\Entity\FieldTypeMetas());
		             $worker->addTargetEntities('fieldTypes', 'Contentinum\Entity\FieldTypes') ;
		             $formFactory = new Mcwork\Form\FieldmetasForm($worker);
		             $formFactory->setDecorators($sl->getServiceLocator()->get('Mcwork\FormDecco'));		             
		             $ctrl = new Mcwork\Controller\EditFormController($formFactory);
		             $ctrl->setWorker($worker);
		             $ctrl->setFormAction('/mcwork/fieldmetas/edit');
		             $ctrl->setToRoute('mcwork_fieldmetas');
		             $ctrl->setExclude(array('field' => 'id'));
		             return $ctrl;		             
		         },
		         'Mcwork\Controller\Conf\DeleteFieldMetas' => function($sl){
		             $em = $sl->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		             $worker = new Mcwork\Model\DeleteItem($em);
		             $entity = new Contentinum\Entity\FieldTypeMetas();
		             $worker->setEntity($entity);
		             $ctrl = new Mcwork\Controller\McworkappController();
		             $ctrl->setWorker($worker);
		             $ctrl->setMethod('deleteRow');
		             $ctrl->setEntity($entity );
		             return $ctrl;		             
		             
		         },
				'Mcwork\Controller\Admin\Logs' => function($sl){
    		        $ctrl = new Mcwork\Controller\McworkappController();
    		        $ctrl->setEntity(new Mcwork\Entity\LogFiles() );
    		        $worker = new \ContentinumComponents\Storage\StorageDirectory();
    		        $worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
    		        $ctrl->setWorker($worker);
    		        return $ctrl;			
		        },
		        'Mcwork\Controller\Admin\Logs\Display' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setEntity(new Mcwork\Entity\LogFiles() );
		        	$worker = new \Mcwork\Model\Filecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },	
		        'Mcwork\Controller\Admin\Logs\Download' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setEntity(new Mcwork\Entity\LogFiles() );
		        	$worker = new \Mcwork\Model\Filecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },
		        'Mcwork\Controller\Admin\Logs\Clear' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setMethod('emptyLogFile');
		        	$ctrl->setEntity(new Mcwork\Entity\LogFiles() );
		        	$worker = new \Mcwork\Model\Filecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },
		        'Mcwork\Controller\Admin\Logs\Delete' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setMethod('deleteLogFile');
		        	$ctrl->setEntity(new Mcwork\Entity\LogFiles() );
		        	$worker = new \Mcwork\Model\Filecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },
		        'Mcwork\Controller\Admin\Cache' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setEntity(new Mcwork\Entity\CacheFiles() );
		        	$worker = new \Mcwork\Model\Cachecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },
		        'Mcwork\Controller\Admin\Cache\Clear' => function($sl){
		        	$ctrl = new Mcwork\Controller\McworkappController();
		        	$ctrl->setMethod('emptyCache');
		        	$ctrl->setEntity(new Mcwork\Entity\CacheFiles() );
		        	$worker = new \Mcwork\Model\Cachecontent();
		        	$worker->setStorage(new \ContentinumComponents\Storage\StorageManager());
		        	$ctrl->setWorker($worker);
		        	return $ctrl;
		        },		        		        		        
		),
);