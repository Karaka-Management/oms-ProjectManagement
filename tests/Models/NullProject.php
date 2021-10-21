<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\tests\Models;

use Modules\ProjectManagement\Models\NullProject;

/**
 * @internal
 */
final class Null extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\ProjectManagement\Models\NullProject
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\ProjectManagement\Models\Project', new NullProject());
    }

    /**
     * @covers Modules\ProjectManagement\Models\NullProject
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullProject(2);
        self::assertEquals(2, $null->getId());
    }
}
