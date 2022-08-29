<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface PointsInterface extends CustomAttributesDataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const ADDRESS = 'address';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const LOCATION = 'location';
    const SHIPPING_ID = 'shipping_id';

    /**
     *
     * @return int|null
     * @since 100.1.0
     */
    public function getEntityId(): int;

    /**
     * @param int $entityId
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setEntityId(int $entityId);

    /**
     * Returns point name
     *
     * @return string
     * @since 100.1.0
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setName(string $name);

    /**
     * Returns point Address
     *
     * @return string
     * @since 100.1.0
     */
    public function getAddress(): string;

    /**
     * @param string $address
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setAddress(string $address);

    /**
     * Returns point Address
     *
     * @return string
     * @since 100.1.0
     */
    public function getLatitude(): string;

    /**
     * @param string $latitude
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setLatitude(string $latitude);

    /**
     * Returns point Address
     *
     * @return string
     * @since 100.1.0
     */
    public function getLongitude(): string;

    /**
     * @param string $longitude
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setLongitude(string $longitude);

    /**
     * Returns point Address
     *
     * @return string
     * @since 100.1.0
     */
    public function getLocation(): string;

    /**
     * @param string $location
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setLocation(string $location);

    /**
     * Returns point Address
     *
     * @return string
     * @since 100.1.0
     */
    public function getShippingId(): string;

    /**
     * @param string $shippingId
     * @return $this
     * @since 100.1.0
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setShippingId(string $shippingId);
}
