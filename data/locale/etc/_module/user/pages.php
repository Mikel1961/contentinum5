<?php
return array(
    
    'login' => array(
        'layout' => 'user/layout',
        'template' => 'content/login',
        'title' => 'Login',
        'headline' => 'User Login',
        'content' => '',
        'app' => array(
            'controller' => 'Mcuser\Controller\LoginController',
            'worker' => 'Mcuser\Model\Auth\Login',
            'entity' => 'Contentinum\Entity\Users5',
            'entitymanager' => 'doctrine.entitymanager.orm_default',
            'form' => 'Mcuser\Form\LoginFrom',
            'formaction' => '/login',
        )
    )
);