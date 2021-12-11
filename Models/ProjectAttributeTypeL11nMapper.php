<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Project mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ProjectAttributeTypeL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'projectmanagement_project_attr_type_l11n_id'        => ['name' => 'projectmanagement_project_attr_type_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'projectmanagement_project_attr_type_l11n_title'     => ['name' => 'projectmanagement_project_attr_type_l11n_title',    'type' => 'string', 'internal' => 'title', 'autocomplete' => true],
        'projectmanagement_project_attr_type_l11n_type'      => ['name' => 'projectmanagement_project_attr_type_l11n_type',      'type' => 'int',    'internal' => 'type'],
        'projectmanagement_project_attr_type_l11n_lang'      => ['name' => 'projectmanagement_project_attr_type_l11n_lang', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'projectmanagement_project_attr_type_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='projectmanagement_project_attr_type_l11n_id';
}
