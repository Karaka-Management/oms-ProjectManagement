<?php
/**
 * Karaka
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

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\Project;
use Modules\ProjectManagement\Models\ProjectMapper;
use Modules\Tasks\Models\Task;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Localization\Money;

/**
 * @internal
 */
final class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\ProjectManagement\Models\ProjectMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $project = new Project();

        $project->setName('Projectname');
        $project->description = 'Description';
        $project->createdBy   = new NullAccount(1);
        $project->start       = new \DateTime('2000-05-05');
        $project->end         = new \DateTime('2005-05-05');

        $money = new Money();
        $money->setString('1.23');

        $project->budgetCosts             = $money;
        $project->budgetEarnings          = $money;
        $project->actualCosts             = $money;
        $project->actualEarnings          = $money;

        $task        = new Task();
        $task->title = 'ProjectTask 1';
        $task->setCreatedBy(new NullAccount(1));

        $task2        = new Task();
        $task2->title = 'ProjectTask 2';
        $task2->setCreatedBy(new NullAccount(1));

        $project->addTask($task);
        $project->addTask($task2);

        $project->progress = 10;
        $project->setProgressType(ProgressType::TASKS);

        $media              = new Media();
        $media->createdBy   = new NullAccount(1);
        $media->description = 'desc';
        $media->setPath('some/path');
        $media->size      = 11;
        $media->extension = 'png';
        $media->name      = 'Project Media';
        $project->addMedia($media);

        $id = ProjectMapper::create()->execute($project);
        self::assertGreaterThan(0, $project->getId());
        self::assertEquals($id, $project->getId());

        $projectR = ProjectMapper::get()->with('media')->where('id', $project->getId())->execute();

        self::assertEquals($project->getName(), $projectR->getName());
        self::assertEquals($project->description, $projectR->description);
        self::assertEquals($project->budgetEarnings->getAmount(), $projectR->budgetEarnings->getAmount());
        self::assertEquals($project->budgetCosts->getAmount(), $projectR->budgetCosts->getAmount());
        self::assertEquals($project->actualCosts->getAmount(), $projectR->actualCosts->getAmount());
        self::assertEquals($project->actualEarnings->getAmount(), $projectR->actualEarnings->getAmount());
        self::assertEquals($project->createdAt->format('Y-m-d'), $projectR->createdAt->format('Y-m-d'));
        self::assertEquals($project->start->format('Y-m-d'), $projectR->start->format('Y-m-d'));
        self::assertEquals($project->end->format('Y-m-d'), $projectR->end->format('Y-m-d'));
        self::assertEquals($project->progress, $projectR->progress);
        self::assertEquals($project->getProgressType(), $projectR->getProgressType());

        $expected = $project->getMedia();
        $actual   = $projectR->getMedia();

        self::assertEquals(\end($expected)->name, \end($actual)->name);
    }

    /**
     * @covers Modules\ProjectManagement\Models\ProjectMapper
     * @group module
     */
    public function testNewest() : void
    {
        $newest = ProjectMapper::getAll()->sort('id', OrderType::DESC)->limit(1)->execute();

        self::assertCount(1, $newest);
    }
}
