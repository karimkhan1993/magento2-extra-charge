<?php
namespace Karim\Extracharge\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class ExtrachargeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Karim\Extracharge\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Karim\Extracharge\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Karim\Extracharge\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $ExtrachargeConfig = [];
        $enabled = $this->dataHelper->isModuleEnabled();
        $minimumOrderAmount = $this->dataHelper->getMinimumOrderAmount();
        $ExtrachargeConfig['fee_label'] = $this->dataHelper->getFeeLabel();
        $quote = $this->checkoutSession->getQuote();
        $subtotal = $quote->getSubtotal();
        $ExtrachargeConfig['custom_fee_amount'] = $this->dataHelper->getExtracharge();
        $ExtrachargeConfig['show_hide_Extracharge_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $ExtrachargeConfig['show_hide_Extracharge_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;
        return $ExtrachargeConfig;
    }
}
