<?php


namespace Operation;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\OperationController::class => Controller\Factory\OperationControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'operations' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/operations',
                    'defaults' => [
                        'controller' => Controller\OperationController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            
        ],
    ],   
    'service_manager' => [
        'factories' => [
            Service\FormManager::class => Service\Factory\FormManagerFactory::class,
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
    ]
];
