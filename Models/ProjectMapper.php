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

use Modules\Admin\Models\AccountMapper;
use Modules\Calendar\Models\CalendarMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Mapper class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
final class ProjectMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'projectmanagement_project_id'              => ['name' => 'projectmanagement_project_id',              'type' => 'int',               'internal' => 'id'],
        'projectmanagement_project_name'            => ['name' => 'projectmanagement_project_name',            'type' => 'string',            'internal' => 'name'],
        'projectmanagement_project_description'     => ['name' => 'projectmanagement_project_description',     'type' => 'string',            'internal' => 'description'],
        'projectmanagement_project_description_raw' => ['name' => 'projectmanagement_project_description_raw', 'type' => 'string',            'internal' => 'descriptionRaw'],
        'projectmanagement_project_calendar'        => ['name' => 'projectmanagement_project_calendar',        'type' => 'int',               'internal' => 'calendar'],
        'projectmanagement_project_budgetcosts'     => ['name' => 'projectmanagement_project_budgetcosts',     'type' => 'Serializable',      'internal' => 'budgetCosts'],
        'projectmanagement_project_budgetearnings'  => ['name' => 'projectmanagement_project_budgetearnings',  'type' => 'Serializable',      'internal' => 'budgetEarnings'],
        'projectmanagement_project_actualearnings'  => ['name' => 'projectmanagement_project_actualearnings',  'type' => 'Serializable',      'internal' => 'actualEarnings'],
        'projectmanagement_project_actualcosts'     => ['name' => 'projectmanagement_project_actualcosts',     'type' => 'Serializable',      'internal' => 'actualCosts'],
        'projectmanagement_project_start'           => ['name' => 'projectmanagement_project_start',           'type' => 'DateTime',          'internal' => 'start'],
        'projectmanagement_project_end'             => ['name' => 'projectmanagement_project_end',             'type' => 'DateTime',          'internal' => 'end'],
        'projectmanagement_project_endestimated'    => ['name' => 'projectmanagement_project_endestimated',    'type' => 'DateTime',          'internal' => 'endEstimated'],
        'projectmanagement_project_progress'        => ['name' => 'projectmanagement_project_progress',        'type' => 'int',               'internal' => 'progress'],
        'projectmanagement_project_progress_type'   => ['name' => 'projectmanagement_project_progress_type',   'type' => 'int',               'internal' => 'progressType'],
        'projectmanagement_project_created_by'      => ['name' => 'projectmanagement_project_created_by',      'type' => 'int',               'internal' => 'createdBy', 'readonly' => true],
        'projectmanagement_project_created_at'      => ['name' => 'projectmanagement_project_created_at',      'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'tasks' => [
            'mapper'   => TaskMapper::class,
            'table'    => 'projectmanagement_task_relation',
            'external' => 'projectmanagement_task_relation_src',
            'self'     => 'projectmanagement_task_relation_dst',
        ],
        'media' => [
            'mapper'   => MediaMapper::class,
            'table'    => 'projectmanagement_project_media',
            'external' => 'projectmanagement_project_media_dst',
            'self'     => 'projectmanagement_project_media_src',
        ],
        'attributes' => [
            'mapper'      => ProjectAttributeMapper::class,
            'table'       => 'projectmanagement_project_attr',
            'self'        => 'projectmanagement_project_attr_project',
            'conditional' => true,
            'external'    => null,
        ],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'calendar' => [
            'mapper'   => CalendarMapper::class,
            'external' => 'projectmanagement_project_calendar',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, external:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'createdBy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'projectmanagement_project_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'projectmanagement_project';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    public const CREATED_AT = 'projectmanagement_project_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='projectmanagement_project_id';
}
