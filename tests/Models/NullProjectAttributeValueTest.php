<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\tests\Models;

use Modules\ProjectManagement\Models\NullProjectAttributeValue;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\ProjectManagement\Models\NullProjectAttributeValue::class)]
final class NullProjectAttributeValueTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\ProjectManagement\Models\ProjectAttributeValue', new NullProjectAttributeValue());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testId() : void
    {
        $null = new NullProjectAttributeValue(2);
        self::assertEquals(2, $null->id);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testJsonSerialize() : void
    {
        $null = new NullProjectAttributeValue(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
