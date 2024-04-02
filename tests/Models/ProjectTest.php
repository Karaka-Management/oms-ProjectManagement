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

use Modules\Admin\Models\NullAccount;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\Project;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\ProjectManagement\Models\Project::class)]
final class ProjectTest extends \PHPUnit\Framework\TestCase
{
    private Project $project;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->project = new Project();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->project->id);
        self::assertInstanceOf('\Modules\Calendar\Models\Calendar', $this->project->calendar);
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->project->createdAt->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->project->start->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->modify('+1 month')->format('Y-m-d'), $this->project->end->format('Y-m-d'));
        self::assertEquals(0, $this->project->createdBy->id);
        self::assertEquals('', $this->project->name);
        self::assertEquals('', $this->project->description);
        self::assertEquals(0, $this->project->budgetCosts->getInt());
        self::assertEquals(0, $this->project->budgetEarnings->getInt());
        self::assertEquals(0, $this->project->actualCosts->getInt());
        self::assertEquals(0, $this->project->actualEarnings->getInt());
        self::assertEquals(0, $this->project->progress);
        self::assertEquals([], $this->project->files);
        self::assertEquals(ProgressType::MANUAL, $this->project->progressType);
        self::assertEmpty($this->project->tasks);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCreatedByInputOutput() : void
    {
        $this->project->createdBy = new NullAccount(1);
        self::assertEquals(1, $this->project->createdBy->id);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDescriptionInputOutput() : void
    {
        $this->project->description = 'Description';
        self::assertEquals('Description', $this->project->description);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testProgressInputOutput() : void
    {
        $this->project->progress = 10;
        self::assertEquals(10, $this->project->progress);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->project->name         = 'Name';
        $this->project->description  = 'Description';
        $this->project->start        = new \DateTime();
        $this->project->end          = new \DateTime();
        $this->project->progress     = 10;
        $this->project->progressType = ProgressType::TASKS;

        $serialized = $this->project->jsonSerialize();
        unset($serialized['calendar']);
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'             => 0,
                'start'          => $this->project->start,
                'end'            => $this->project->end,
                'name'           => 'Name',
                'description'    => 'Description',
                'budgetCosts'    => new FloatInt(),
                'budgetEarnings' => new FloatInt(),
                'actualCosts'    => new FloatInt(),
                'actualEarnings' => new FloatInt(),
                'tasks'          => [],
                'media'          => [],
                'progress'       => 10,
                'progressType'   => ProgressType::TASKS,
            ],
            $serialized
        );
    }
}
