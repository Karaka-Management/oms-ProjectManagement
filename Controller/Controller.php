<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\ProjectManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Controller;

use phpOMS\Module\ModuleAbstract;

/**
 * Event Management controller class.
 *
 * @package Modules\ProjectManagement
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Controller extends ModuleAbstract
{
    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__ . '/../';

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const NAME = 'ProjectManagement';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const ID = 1001700000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static array $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    protected static array $dependencies = [];
}
