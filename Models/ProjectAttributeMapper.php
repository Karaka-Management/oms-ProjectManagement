<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Project mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ProjectAttributeMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'projectmanagement_project_attr_id'      => ['name' => 'projectmanagement_project_attr_id',      'type' => 'int', 'internal' => 'id'],
        'projectmanagement_project_attr_project' => ['name' => 'projectmanagement_project_attr_project', 'type' => 'int', 'internal' => 'project'],
        'projectmanagement_project_attr_type'    => ['name' => 'projectmanagement_project_attr_type',    'type' => 'int', 'internal' => 'type'],
        'projectmanagement_project_attr_value'   => ['name' => 'projectmanagement_project_attr_value',   'type' => 'int', 'internal' => 'value'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'type' => [
            'mapper'   => ProjectAttributeTypeMapper::class,
            'external' => 'projectmanagement_project_attr_type',
        ],
        'value' => [
            'mapper'   => ProjectAttributeValueMapper::class,
            'external' => 'projectmanagement_project_attr_value',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'projectmanagement_project_attr';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='projectmanagement_project_attr_id';
}
