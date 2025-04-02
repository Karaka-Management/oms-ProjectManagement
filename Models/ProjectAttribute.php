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

/**
 * Project class.
 *
 * @package Modules\ProjectManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class ProjectAttribute implements \JsonSerializable
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

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
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'      => $this->id,
            'project' => $this->project,
            'type'    => $this->type,
            'value'   => $this->value,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
