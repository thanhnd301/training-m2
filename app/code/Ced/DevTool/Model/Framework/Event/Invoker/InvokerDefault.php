<?php 

/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End User License Agreement (EULA)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://cedcommerce.com/license-agreement.txt
 *
 * @category  Ced
 * @package   Ced_DevTool
 * @author    CedCommerce Core Team <connect@cedcommerce.com>
 * @copyright Copyright CedCommerce (http://cedcommerce.com/)
 * @license   http://cedcommerce.com/license-agreement.txt
 */

namespace Ced\DevTool\Model\Framework\Event\Invoker;

use Magento\Framework\Event\Observer;
use Zend\Stdlib\Exception\LogicException;

class InvokerDefault extends \Magento\Framework\Event\Invoker\InvokerDefault
{
    /**
     * Observer model factory
     *
     * @var \Magento\Framework\Event\ObserverFactory
     */
    protected $_observerFactory;

    /**
     * Application state
     *
     * @var \Magento\Framework\App\State
     */
    protected $_appState;
	 
	/**
     * DeveloperTool Helper
     *
     * @var \Ced\DevTool\Helper\Data
     */
    protected $_devHelper;

    /**
     * @param \Magento\Framework\Event\ObserverFactory $observerFactory
     * @param \Magento\Framework\App\State $appState
     */
    public function __construct(\Magento\Framework\Event\ObserverFactory $observerFactory, \Magento\Framework\App\State $appState,
	\Ced\DevTool\Helper\Data $helper
	)
    {
        $this->_observerFactory = $observerFactory;
        $this->_appState = $appState;
		$this->_devHelper =$helper;
		
    }

    /**
     * Dispatch event
     *
     * @param array $configuration
     * @param Observer $observer
     * @return void
     */
    public function dispatch(array $configuration, Observer $observer)
    {
		
        /** Check whether event observer is disabled */
        if (isset($configuration['disabled']) && true === $configuration['disabled']) {
            return;
        }

        if (isset($configuration['shared']) && false === $configuration['shared']) {
            $object = $this->_observerFactory->create($configuration['instance']);
        } else {
            $object = $this->_observerFactory->get($configuration['instance']);
        }
		$this->_devHelper->setObserverDetails($configuration,get_class($object));
        $this->_callObserverMethod($object, $configuration['method'], $observer);
    }

    /**
     * Performs non-existent observer method calls protection
     *
     * @param object $object
     * @param string $method
     * @param Observer $observer
     * @return $this
     * @throws \LogicException
     */
    protected function _callObserverMethod($object, $method, $observer)
    {
        if (method_exists($object, $method) && is_callable([$object, $method])) {
            $object->{$method}($observer);
        } elseif ($this->_appState->getMode() == \Magento\Framework\App\State::MODE_DEVELOPER) {
            throw new \LogicException('Method "' . $method . '" is not defined in "' . get_class($object) . '"');
        }
        return $this;
    }
}
