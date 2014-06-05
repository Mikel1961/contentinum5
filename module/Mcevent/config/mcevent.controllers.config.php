<?php
return array(
    'invokables' => array(
        'Mcevent\Controller\Index' => 'Mcevent\Controller\IndexController',
        'Mcevent\Controller\Event' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Event\Organizer' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Event\Resources' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Resources\Types' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Calender\Types' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Calender\Groups' => 'Mcevent\Controller\MceventappController',
        'Mcevent\Controller\Event\Configuration' => 'Mcevent\Controller\MceventappController'
    )
);