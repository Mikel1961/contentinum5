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
				'Mcwork\Controller\Content\Medias' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Conf' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Conf\Fieldtypes' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Conf\Fieldmetas' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin\Accounts' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin\Contacts' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Admin\Users' => 'Mcwork\Controller\McworkappController',
				'Mcwork\Controller\Apps' => 'Mcwork\Controller\McworkappController',
		),
		'factories' => array(
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