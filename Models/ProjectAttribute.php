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

use phpOMS\Contract\ArrayableInterface;

/**
 * Project class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class ProjectAttribute implements \JsonSerializable, ArrayableInterface
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Project this attribute belongs to
     *
     * @var int
     * @since 1.0.0
     */
    public int $project = 0;

    /**
     * Attribute type the attribute belongs to
     *
     * @var ProjectAttributeType
     * @since 1.0.0
     */
    public ProjectAttributeType $type;

    /**
     * Attribute value the attribute belongs to
     *
     * @var ProjectAttributeValue
     * @since 1.0.0
     */
    public ProjectAttributeValue $value;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->type  = new NullProjectAttributeType();
        $this->value = new NullProjectAttributeValue();
    }

    /**
     * Get id
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
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'    => $this->id,
            'item'  => $this->item,
            'type'  => $this->type,
            'value' => $this->value,
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
