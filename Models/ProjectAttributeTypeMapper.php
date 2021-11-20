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

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Project mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class ProjectAttributeTypeMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'projectmanagement_project_attr_type_id'       => ['name' => 'projectmanagement_project_attr_type_id',     'type' => 'int',    'internal' => 'id'],
        'projectmanagement_project_attr_type_name'     => ['name' => 'projectmanagement_project_attr_type_name',   'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'projectmanagement_project_attr_type_fields'   => ['name' => 'projectmanagement_project_attr_type_fields', 'type' => 'int',    'internal' => 'fields'],
        'projectmanagement_project_attr_type_custom'   => ['name' => 'projectmanagement_project_attr_type_custom', 'type' => 'bool', 'internal' => 'custom'],
        'projectmanagement_project_attr_type_pattern'  => ['name' => 'projectmanagement_project_attr_type_pattern', 'type' => 'string', 'internal' => 'validationPattern'],
        'projectmanagement_project_attr_type_required' => ['name' => 'projectmanagement_project_attr_type_required', 'type' => 'bool', 'internal' => 'isRequired'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'l11n' => [
            'mapper'            => ProjectAttributeTypeL11nMapper::class,
            'table'             => 'projectmanagement_project_attr_type_l11n',
            'self'              => 'projectmanagement_project_attr_type_l11n_type',
            'column'            => 'title',
            'conditional'       => true,
            'external'          => null,
        ],
        'defaults' => [
            'mapper'            => ProjectAttributeValueMapper::class,
            'table'             => 'projectmanagement_project_attr_default',
            'self'              => 'projectmanagement_project_attr_default_type',
            'external'          => 'projectmanagement_project_attr_default_value',
            'conditional'       => false,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'projectmanagement_project_attr_type';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'projectmanagement_project_attr_type_id';
}
