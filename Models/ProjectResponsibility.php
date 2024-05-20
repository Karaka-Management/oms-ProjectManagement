<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Project responsibility type enum.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class ProjectResponsibility extends Enum
{
    public const MANAGER = 1;

    public const OTHER = 2;
}
