<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\ProjectManagement\Controller\BackendController;
use Modules\ProjectManagement\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/projectmanagement/list.*$' => [
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
    '^.*/projectmanagement/create.*$' => [
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
    '^.*/projectmanagement/profile.*$' => [
        [
            'dest'       => '\Modules\ProjectManagement\Controller\BackendController:viewProjectManagementProfile',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
];
