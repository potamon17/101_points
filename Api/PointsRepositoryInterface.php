<?php
/**
 * Copyright © Andriy Stetsiuk. All rights reserved.
 */
namespace Andriy\Points\Api;

use Andriy\Points\Api\Data\PointsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

interface PointsRepositoryInterface
{

    /**
     * @param PointsInterface $point
     * @return PointsInterface
     * @throws CouldNotSaveException
     * @since 100.1.0
     */
    public function save(PointsInterface $point): PointsInterface;

    /**
     * @param int $pointId
     * @return PointsInterface
     * @throws PointsInterface
     * @since 100.1.0
     */
    public function get(int $pointId): array;

    /**
     * @param PointsInterface $point
     * @return bool
     * @throws PointsInterface
     * @since 100.1.0
     */
    public function delete(PointsInterface $point): bool;

    /**
     * @param int $pointId
     * @return bool
     * @throws CouldNotDeleteException
     * @since 100.1.0
     */
    public function deleteById(int $pointId): bool;


}
