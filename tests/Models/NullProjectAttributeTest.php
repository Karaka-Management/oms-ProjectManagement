<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\tests\Models;

use Modules\ProjectManagement\Models\NullProjectAttribute;

/**
 * @internal
 */
final class NullProjectAttributeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\ProjectManagement\Models\NullProjectAttribute
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\ProjectManagement\Models\ProjectAttribute', new NullProjectAttribute());
    }

    /**
     * @covers \Modules\ProjectManagement\Models\NullProjectAttribute
     * @group module
     */
    public function testId() : void
    {
        $null = new NullProjectAttribute(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\ProjectManagement\Models\NullProjectAttribute
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullProjectAttribute(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
