<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Project mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
final class ProjectAttributeTypeMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'projectmanagement_project_attr_type_id'       => ['name' => 'projectmanagement_project_attr_type_id',       'type' => 'int',    'internal' => 'id'],
        'projectmanagement_project_attr_type_name'     => ['name' => 'projectmanagement_project_attr_type_name',     'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'projectmanagement_project_attr_type_fields'   => ['name' => 'projectmanagement_project_attr_type_fields',   'type' => 'int',    'internal' => 'fields'],
        'projectmanagement_project_attr_type_custom'   => ['name' => 'projectmanagement_project_attr_type_custom',   'type' => 'bool',   'internal' => 'custom'],
        'projectmanagement_project_attr_type_pattern'  => ['name' => 'projectmanagement_project_attr_type_pattern',  'type' => 'string', 'internal' => 'validationPattern'],
        'projectmanagement_project_attr_type_required' => ['name' => 'projectmanagement_project_attr_type_required', 'type' => 'bool',   'internal' => 'isRequired'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => ProjectAttributeTypeL11nMapper::class,
            'table'    => 'projectmanagement_project_attr_type_l11n',
            'self'     => 'projectmanagement_project_attr_type_l11n_type',
            'column'   => 'title',
            'external' => null,
        ],
        'defaults' => [
            'mapper'   => ProjectAttributeValueMapper::class,
            'table'    => 'projectmanagement_project_attr_default',
            'self'     => 'projectmanagement_project_attr_default_type',
            'external' => 'projectmanagement_project_attr_default_value',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'projectmanagement_project_attr_type';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='projectmanagement_project_attr_type_id';
}
