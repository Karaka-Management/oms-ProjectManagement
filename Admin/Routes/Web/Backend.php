<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\ProjectManagement\Controller\BackendController;
use Modules\ProjectManagement\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/projectmanagement/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^/projectmanagement/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^/projectmanagement/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
];
