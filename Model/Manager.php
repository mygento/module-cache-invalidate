<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_CacheInvalidate
 */

namespace Mygento\CacheInvalidate\Model;

class Manager
{
    const TOPIC_NAME = 'magento.cache.invalidate';

    /**
     * @var \Magento\Framework\MessageQueue\PublisherInterface
     */
    private $publisher;

    /**
     * @param \Magento\Framework\MessageQueue\PublisherInterface $publisher
     */
    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * @param array $tags
     */
    public function publish(array $tags)
    {
        $this->publisher->publish(self::TOPIC_NAME, $tags);
    }
}
