<?php

/**
 * Copyright © 2023 All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PixieMedia\GiftMessage\Plugin\Backend\Magento\Sales\Model\ResourceModel\Order\Grid;

class Collection
{
    /**
     * Plugin method to modify the beforeLoad() function of \Magento\Sales\Model\ResourceModel\Order\Grid\Collection class.
     *
     * @param \Magento\Sales\Model\ResourceModel\Order\Grid\Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     */
    public function beforeLoad(
        \Magento\Sales\Model\ResourceModel\Order\Grid\Collection $subject,
        $printQuery = false,
        $logQuery = false
    ) {
        if (!$subject->isLoaded()) {
            $gift = $subject->getResource()->getTable('gift_message');
            $sales = $subject->getResource()->getTable('sales_order');
            $subject->getSelect()
                ->joinLeft(
                    ['sales_order' => $sales],
                    $sales . '.entity_id = main_table.entity_id',
                    ['sales_order' => $sales . '.gift_message_id']
                )->joinLeft(
                    ['gift_message' => $gift],
                    $gift . '.gift_message_id = sales_order.gift_message_id',
                    ['gift_message' => $gift . '.message']
                );
        }
        return [$printQuery, $logQuery];
    }
}
