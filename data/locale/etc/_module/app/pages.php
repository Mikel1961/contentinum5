<?php
return array(
    
    '_default' => array(
        'layout' => 'contentinum/layout',
        'template' => 'contentinum/application',
        'app' => array(
            'controller' => 'Contentinum\Controller\ApplicationController',
            'worker' => 'Contentinum\Model\Content',
            'entity' => 'Contentinum\Entity\WebPagesContent',
            'entitymanager' => 'doctrine.entitymanager.orm_default',
        )
    )
);