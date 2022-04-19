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
final class ProjectAttributeValueMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'projectmanagement_project_attr_value_id'       => ['name' => 'projectmanagement_project_attr_value_id',       'type' => 'int',      'internal' => 'id'],
        'projectmanagement_project_attr_value_default'  => ['name' => 'projectmanagement_project_attr_value_default',  'type' => 'bool',     'internal' => 'isDefault'],
        'projectmanagement_project_attr_value_type'     => ['name' => 'projectmanagement_project_attr_value_type',     'type' => 'int',      'internal' => 'type'],
        'projectmanagement_project_attr_value_valueStr' => ['name' => 'projectmanagement_project_attr_value_valueStr', 'type' => 'string',   'internal' => 'valueStr'],
        'projectmanagement_project_attr_value_valueInt' => ['name' => 'projectmanagement_project_attr_value_valueInt', 'type' => 'int',      'internal' => 'valueInt'],
        'projectmanagement_project_attr_value_valueDec' => ['name' => 'projectmanagement_project_attr_value_valueDec', 'type' => 'float',    'internal' => 'valueDec'],
        'projectmanagement_project_attr_value_valueDat' => ['name' => 'projectmanagement_project_attr_value_valueDat', 'type' => 'DateTime', 'internal' => 'valueDat'],
        'projectmanagement_project_attr_value_lang'     => ['name' => 'projectmanagement_project_attr_value_lang',     'type' => 'string',   'internal' => 'language'],
        'projectmanagement_project_attr_value_country'  => ['name' => 'projectmanagement_project_attr_value_country',  'type' => 'string',   'internal' => 'country'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'projectmanagement_project_attr_value';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='projectmanagement_project_attr_value_id';
}
