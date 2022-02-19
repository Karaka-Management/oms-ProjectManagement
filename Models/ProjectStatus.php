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

use phpOMS\Stdlib\Base\Enum;

/**
 * Project status enum.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
abstract class ProjectStatus extends Enum
{
    public const ACTIVE = 0;

    public const INACTIVE = 1;

    public const HOLD = 2;

    public const CANCELED = 3;

    public const FINISHED = 4;
}
