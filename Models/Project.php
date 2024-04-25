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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Calendar;
use Modules\Tasks\Models\Task;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * Project class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Project
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Start date.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $start;

    /**
     * End date.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $end;

    /**
     * Estimated end date.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $endEstimated;

    /**
     * Project name.
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

    /**
     * Project description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Project raw description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $descriptionRaw = '';

    /**
     * Calendar.
     *
     * @var Calendar
     * @since 1.0.0
     */
    public Calendar $calendar;

    /**
     * Budget costs.
     *
     * @var FloatInt
     * @since 1.0.0
     */
    public FloatInt $budgetCosts;

    /**
     * Budget earnings.
     *
     * @var FloatInt
     * @since 1.0.0
     */
    public FloatInt $budgetEarnings;

    /**
     * Current total costs.
     *
     * @var FloatInt
     * @since 1.0.0
     */
    public FloatInt $actualCosts;

    /**
     * Current total earnings.
     *
     * @var FloatInt
     * @since 1.0.0
     */
    public FloatInt $actualEarnings;

    /**
     * Progress percentage.
     *
     * @var int
     * @since 1.0.0
     */
    public int $progress = 0;

    /**
     * Progress calculation.
     *
     * @var int
     * @since 1.0.0
     */
    public int $progressType = ProgressType::MANUAL;

    /**
     * Created at.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Created by.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdBy;

    /**
     * Tasks.
     *
     * @var Task[]
     * @since 1.0.0
     */
    public array $tasks = [];

    public int $unit = 0;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->start = new \DateTime('now');
        $this->end   = new \DateTime('now');
        $this->end->modify('+1 month');

        $this->endEstimated = clone $this->end;
        $this->createdAt    = new \DateTimeImmutable('now');
        $this->createdBy    = new NullAccount();

        $this->calendar = new Calendar();

        $this->actualCosts    = new FloatInt();
        $this->actualEarnings = new FloatInt();
        $this->budgetCosts    = new FloatInt();
        $this->budgetEarnings = new FloatInt();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'             => $this->id,
            'start'          => $this->start,
            'end'            => $this->end,
            'name'           => $this->name,
            'description'    => $this->description,
            'calendar'       => $this->calendar,
            'budgetCosts'    => $this->budgetCosts,
            'budgetEarnings' => $this->budgetEarnings,
            'actualCosts'    => $this->actualCosts,
            'actualEarnings' => $this->actualEarnings,
            'tasks'          => $this->tasks,
            'media'          => $this->files,
            'progress'       => $this->progress,
            'progressType'   => $this->progressType,
            'createdAt'      => $this->createdAt,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }

    use \Modules\Media\Models\MediaListTrait;
    use \Modules\Attribute\Models\AttributeHolderTrait;
    // @todo implement tags
}
