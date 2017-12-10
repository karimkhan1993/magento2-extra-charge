<?php
namespace Karim\Extracharge\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddFeeToOrderObserver implements ObserverInterface
{
    /**
     * Set payment fee to order
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $ExtrachargeFee = $quote->getFee();
        if (!$ExtrachargeFee) {
            return $this;
        }
        //Set fee data to order
        $order = $observer->getOrder();
        $order->setData('fee', $ExtrachargeFee);
        
		return $this;
    }
}
