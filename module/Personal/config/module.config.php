<?php
namespace Personal;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'personal' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/personal[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller'    => Controller\PersonalController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\PersonalController::class => Controller\Factory\PersonalControllerFactory::class,            
        ],
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    // 'access_filter' => [
    //     'controllers' => [
    //         Controller\UserController::class => [
    //             // Give access to "resetPassword", "message" and "setPassword" actions
    //             // to anyone.
    //             ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
    //             // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
    //             ['actions' => ['index', 'add', 'edit', 'view', 'changePassword'], 'allow' => '@']
    //         ],
    //     ]
    // ],
    'service_manager' => [
        'factories' => [
            Service\PersonalManager::class => Service\Factory\PersonalManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];
