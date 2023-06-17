<?php
/**
 * Jingga
 *
 * PHP Version 8.1
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
 * Progress type enum.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class ProgressType extends Enum
{
    public const MANUAL = 0;

    public const LINEAR = 1;

    public const EXPONENTIAL = 2;

    public const LOG = 3;

    public const TASKS = 4;
}
