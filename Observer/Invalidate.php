<?php

/**
 * @author Mygento Team
 * @copyright 2020 Mygento (https://www.mygento.ru)
 * @package Mygento_CacheInvalidate
 */

namespace Mygento\CacheInvalidate\Observer;

class Invalidate implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\App\Cache\Tag\Resolver
     */
    private $resolver;

    /**
     * @var \Mygento\CacheInvalidate\Model\Manager
     */
    private $manager;

    /**
     * @var \Magento\PageCache\Model\Config
     */
    private $config;

    /**
     * @param \Mygento\CacheInvalidate\Model\Manager $manager
     * @param \Magento\PageCache\Model\Config $config
     * @param \Magento\Framework\App\Cache\Tag\Resolver $resolver
     */
    public function __construct(
        \Mygento\CacheInvalidate\Model\Manager $manager,
        \Magento\PageCache\Model\Config $config,
        \Magento\Framework\App\Cache\Tag\Resolver $resolver
    ) {
        $this->config = $config;
        $this->manager = $manager;
        $this->resolver = $resolver;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $object = $observer->getEvent()->getObject();
        if (!is_object($object)) {
            return;
        }

        if (!$this->config->isEnabled()) {
            return;
        }

        $tags = $this->resolver->getTags($object);

        if (!empty($tags)) {
            $this->manager->publish(array_unique($tags));
        }
    }
}
