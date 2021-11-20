<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\ProjectManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Calendar;
use Modules\Media\Models\Media;
use Modules\Tasks\Models\Task;
use phpOMS\Localization\Money;

/**
 * Project class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
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
    protected int $id = 0;

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
    private string $name = '';

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
     * @var Money
     * @since 1.0.0
     */
    public Money $budgetCosts;

    /**
     * Budget earnings.
     *
     * @var Money
     * @since 1.0.0
     */
    public Money $budgetEarnings;

    /**
     * Current total costs.
     *
     * @var Money
     * @since 1.0.0
     */
    public Money $actualCosts;

    /**
     * Current total earnings.
     *
     * @var Money
     * @since 1.0.0
     */
    public Money $actualEarnings;

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
    private int $progressType = ProgressType::MANUAL;

    /**
     * Media files.
     *
     * @var array<int, int|media>
     * @since 1.0.0
     */
    private array $media = [];

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
    private $tasks = [];

    /**
     * Attributes.
     *
     * @var int[]|ProjectAttribute[]
     * @since 1.0.0
     */
    private array $attributes = [];

    /**
     * Constructor.
     *
     * @param string $name Name of the project
     *
     * @since 1.0.0
     */
    public function __construct(string $name = '')
    {
        $this->start = new \DateTime('now');
        $this->end   = new \DateTime('now');
        $this->end->modify('+1 month');

        $this->endEstimated = clone $this->end;
        $this->createdAt    = new \DateTimeImmutable('now');
        $this->createdBy    = new NullAccount();

        $this->calendar = new Calendar();

        $this->actualCosts    = new Money();
        $this->actualEarnings = new Money();
        $this->budgetCosts    = new Money();
        $this->budgetEarnings = new Money();

        $this->setName($name);
    }

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get all media files.
     *
     * @return array<int, int|Media>
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media
     *
     * @param int|Media $media Media
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Remove media
     *
     * @param int $id Media id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeMedia(int $id) : bool
    {
        if (isset($this->media[$id])) {
            unset($this->media[$id]);

            return true;
        }

        return false;
    }

    /**
     * Add task
     *
     * @param Task $task Task
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTask(Task $task) : void
    {
        $this->tasks[] = $task;
    }

    /**
     * Remove task
     *
     * @param int $id Task id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeTask(int $id) : bool
    {
        if (isset($this->tasks[$id])) {
            unset($this->tasks[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get progress type
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getProgressType() : int
    {
        return $this->progressType;
    }

    /**
     * Set progress type
     *
     * @param int $type Progress type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setProgressType(int $type) : void
    {
        $this->progressType = $type;
    }

    /**
     * Get task
     *
     * @param int $id Task id
     *
     * @return Task
     *
     * @since 1.0.0
     */
    public function getTask(int $id) : Task
    {
        return $this->tasks[$id] ?? new Task();
    }

    /**
     * Get tasks
     *
     * @return Task[]
     *
     * @since 1.0.0
     */
    public function getTasks() : array
    {
        return $this->tasks;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name Project name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name           = $name;
        $this->calendar->name = $name;
    }

    /**
     * Add attribute to item
     *
     * @param ProjectAttribute $attribute Note
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAttribute(ProjectAttribute $attribute) : void
    {
        $this->attributes[] = $attribute;
    }

    /**
     * Get attributes
     *
     * @return int[]|ProjectAttribute[]
     *
     * @since 1.0.0
     */
    public function getAttributes() : array
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'                   => $this->id,
            'start'                => $this->start,
            'end'                  => $this->end,
            'name'                 => $this->name,
            'description'          => $this->description,
            'calendar'             => $this->calendar,
            'budgetCosts'          => $this->budgetCosts,
            'budgetEarnings'       => $this->budgetEarnings,
            'actualCosts'          => $this->actualCosts,
            'actualEarnings'       => $this->actualEarnings,
            'tasks'                => $this->tasks,
            'media'                => $this->media,
            'progress'             => $this->progress,
            'progressType'         => $this->progressType,
            'createdAt'            => $this->createdAt,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
