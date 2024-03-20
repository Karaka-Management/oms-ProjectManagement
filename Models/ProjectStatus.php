<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Project status enum.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class ProjectStatus extends Enum
{
    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const HOLD = 3;

    public const CANCELED = 4;

    public const FINISHED = 5;
}
