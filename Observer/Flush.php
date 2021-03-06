<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_CacheInvalidate
 */

namespace Mygento\CacheInvalidate\Observer;

class Flush implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\PageCache\Model\Config
     */
    private $config;

    /**
     * @var \Mygento\CacheInvalidate\Model\Manager
     */
    private $manager;

    /**
     * @param \Mygento\CacheInvalidate\Model\Manager $manager
     * @param \Magento\PageCache\Model\Config $config
     */
    public function __construct(
        \Mygento\CacheInvalidate\Model\Manager $manager,
        \Magento\PageCache\Model\Config $config
    ) {
        $this->manager = $manager;
        $this->config = $config;
    }

    /**
     * Execute
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->config->isEnabled()) {
            $this->manager->publish(['ALL']);
        }
    }
}
